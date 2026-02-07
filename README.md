# ForumOS (Laravel 11)

Production-minded forum application blueprint with admin moderation, realtime updates via Reverb, AI moderation/summarization, monetization hooks, and installation tooling.

See `docs/ARCHITECTURE.md` for phase-by-phase implementation details.


## Local run
Serve the app using the `public/` document root:

```bash
php -S 127.0.0.1:8000 -t public
```

If you see a setup page, install dependencies first (`composer install`).


## Preview mode without dependencies
If `vendor/` is not installed yet, visiting `/` still renders a working preview UI (thread list + thread detail) instead of a not-found page.
