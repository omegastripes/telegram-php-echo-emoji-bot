# Echo emoji bot
Telegram simple php Echo emoji bot

Find it on telegram @echo_text_bot

This bot helps to insert emoji chars into php code. Just send him any emoji and it will echo it wrapped into `json_decode()`.

Upload the script `echo_emoji_bot.php` to your shared web hosting directory and setup telegram webhook as described [here](https://core.telegram.org/bots/api#setwebhook) by the link `https://api.telegram.org/bot0123456789:ABCDEFGHIJKLMNOPQRSTUVWXYZABCDEFGHI/setWebhook?url=https://your.web.site/echo_emoji_bot.php`. Make sure you have setup SSL on the domain for webhook calls  (at least Let's Encrypt or Cloudflare which are free).
