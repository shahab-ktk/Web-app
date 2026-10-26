# One-time Ubuntu server setup for CI/CD

This deployment is designed for a separate site directory (`/var/www/brightlane`) and a separate hostname. It does not change the existing SabziCart or Laravel site. The GitHub Actions workflow deploys over SSH and never uploads `.env`, `vendor/`, or `storage/`.

## 1. Prepare the destination directory

Log in as the same Linux user that GitHub Actions will SSH as, then run:

```bash
sudo mkdir -p /var/www/brightlane
sudo chown "$USER":www-data /var/www/brightlane
sudo chmod 2775 /var/www/brightlane
sudo mkdir -p /var/www/brightlane/storage/framework/cache/data \
  /var/www/brightlane/storage/framework/sessions \
  /var/www/brightlane/storage/framework/views \
  /var/www/brightlane/storage/logs \
  /var/www/brightlane/bootstrap/cache
sudo chown -R "$USER":www-data /var/www/brightlane
sudo find /var/www/brightlane -type d -exec chmod 2755 {} \;
sudo chmod 2775 /var/www/brightlane
sudo chmod -R ug+rwX /var/www/brightlane/storage /var/www/brightlane/bootstrap/cache
```

`www-data` is the common Nginx/PHP-FPM group on Ubuntu. Adjust this if your PHP-FPM pool uses a different account/group.

## 2. Configure Nginx once

Copy/adapt `nginx.conf.example` to `/etc/nginx/sites-available/brightlane`, change `YOUR_NEW_DOMAIN`, and verify the PHP-FPM socket with `ls /run/php/`. Enable it, then test and reload Nginx:

```bash
sudo ln -s /etc/nginx/sites-available/brightlane /etc/nginx/sites-enabled/brightlane
sudo nginx -t && sudo systemctl reload nginx
```

Do not create a duplicate symlink if it already exists. Make sure the new DNS record points to this server. After HTTP works publicly, obtain TLS with `sudo certbot --nginx -d YOUR_NEW_DOMAIN`.

## 3. Set up a dedicated SSH deployment key

Use a dedicated key for this deployment rather than placing a server password in GitHub. On your trusted development computer, generate a key pair (the CI private key must be stored only as a GitHub Secret):

```powershell
ssh-keygen -t ed25519 -C "github-actions-deploy" -f "$env:USERPROFILE\.ssh\brightlane_deploy"
```

Add the contents of `brightlane_deploy.pub` to the chosen deployment user's `~/.ssh/authorized_keys` on the server. Ensure permissions:

```bash
chmod 700 ~/.ssh
chmod 600 ~/.ssh/authorized_keys
```

Use a deployment user with access only to the required app directory where practical. Do not give CI a root SSH login, and do not give the deployment user broad passwordless `sudo` rights.

### Verify the SSH host key

On the server, inspect its SSH host-key fingerprint:

```bash
sudo ssh-keygen -lf /etc/ssh/ssh_host_ed25519_key.pub
```

On your trusted computer, capture the host key and verify its fingerprint matches before trusting it. Then paste the verified `known_hosts` line(s) into the GitHub secret `DEPLOY_KNOWN_HOSTS`:

```bash
ssh-keyscan -t ed25519 -H YOUR_SERVER_IP
```

Do not blindly trust a key-scan result: compare its fingerprint with the server fingerprint first.

## 4. Add GitHub Actions settings

In GitHub, open the repository's **Settings → Secrets and variables → Actions**.

Add these **repository secrets**:

- `DEPLOY_HOST`: the server's public IP or SSH hostname (no `https://`).
- `DEPLOY_USER`: the Linux account that accepts the deployment key.
- `DEPLOY_SSH_PRIVATE_KEY`: the complete private key from `brightlane_deploy`, including its header/footer. Never commit this value.
- `DEPLOY_KNOWN_HOSTS`: the verified host key line(s).
- `DEPLOY_PATH`: `/var/www/brightlane`.

Add this **repository variable** under the Variables tab:

- `APP_URL`: the full site URL, such as `https://your-new-domain.example`.

The example domain above is a placeholder. Use a hostname you own/control and ensure DNS points to this server. None of these values need to be personal phone/email data. SSH key material belongs in GitHub Secrets, never in source files.

## 5. First deployment

1. Push this project to a GitHub repository with the default branch named `main`.
2. Configure the server directory and Nginx as above.
3. Add the secrets and `APP_URL` variable.
4. In the repository, open **Actions** and run **CI and Deploy** on `main`, or push a commit to `main`.
5. The workflow tests the project first. Only after tests pass on `main` does it upload code and run the remote deployment steps.
6. Check the GitHub Actions log. Never paste private keys, `.env`, passwords, or tokens into issue comments or logs.

## What the workflow preserves

- `.env` remains on the server and is never synced from GitHub.
- `storage/` remains on the server so logs and framework runtime files are not removed.
- `vendor/` is installed on the target server via Composer.
- The demo contact form validates and confirms input, but deliberately does not store or email submissions. It contains no personal contact details or mail credentials.

This is a simple direct deployment (not a zero-downtime release/symlink system). For high-traffic production sites, use versioned releases, a rollback procedure, backups, and a staging environment.
