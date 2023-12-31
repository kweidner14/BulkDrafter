# Bulk Draft URLs for WordPress

This PHP script processes a list of URLs from a CSV file and sets the corresponding WordPress posts to a draft status. Due to potential server timeout issues, the script processes URLs in chunks.

## Prerequisites

- A WordPress installation.
- SSH or FTP access to the server where WordPress is hosted.
- A CSV file named `bulk-draft-urls.csv` containing the URLs you wish to set as drafts.

## Usage

1. Upload the PHP script to the root directory of your WordPress installation.
2. Navigate to the script in your browser, appending the chunk number as a URL parameter:
`yoursite.com/script-name.php?chunk=1`
3. Once that chunk is processed, increment the chunk number and run the script again:
`yoursite.com/script-name.php?chunk=2` ... and so on, until you've processed all the chunks necessary to cover all URLs in your CSV file.
4. After completion, **ensure to delete the script** from your server for security reasons.

## Configuration

- By default, the script is set to process 50 URLs per chunk. You can adjust the `$urls_per_chunk` variable to a number that best suits your server environment.

## Logging

If you wish to log the process, uncomment the relevant `error_log` lines in the script. This will provide logs for each URL processed, the associated post ID, and the current line count.
