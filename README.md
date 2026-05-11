# acts.lib.unb.ca — static one-pager

Coming-soon page for the Atlantic Canadian Theatre Site, served by
`unb-libraries/nginx` while the full Drupal rebuild is in flight on `dev`.

## Local development

    composer install              # pulls dockworker-daemon (dev-only)
    docker compose up --build
    open http://localhost:3092

Local edits to `html/` are picked up live via `docker-compose.override.yml`
(bind-mount); no rebuild needed.

## Branch model

`newacts` is an orphan branch with no shared history with `dev`. The Drupal
rebuild stays on `dev` independently.

    git checkout dev              # Drupal rebuild
    git checkout newacts          # this static page

## Deploy

CI builds and pushes the image to
`ghcr.io/unb-libraries/acts.lib.unb.ca:newacts`. Deploy to k8s is gated on
`deploy-branches: []` until the existing `acts-lib-unb-ca` Deployment
manifest is patched to drop Drupal-specific probes, secrets, and sidecars.
