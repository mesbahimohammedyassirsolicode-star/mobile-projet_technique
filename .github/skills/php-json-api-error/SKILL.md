---
name: php-json-api-error
description: "Diagnose and fix PHP API responses that fail JSON parsing, especially 'Unexpected token <', '<br /> <b>', 'is not valid JSON', fetch response.json() errors, PHP warnings, notices, and fatal errors returned as HTML."
argument-hint: "Optional endpoint or frontend file to inspect"
user-invocable: true
disable-model-invocation: false
---

# PHP JSON API Error Troubleshooting

Use this workflow when a frontend expects JSON but receives HTML, commonly shown as:

`Unexpected token '<', "<br /> <b>"... is not valid JSON`

## Procedure

1. Locate the frontend request and the PHP endpoint.
   - Search for `fetch`, `response.json()`, `JSON.parse`, `php://input`, `json_encode`, and the endpoint URL.
   - Trace every `require_once`/`include` used by the endpoint.
2. Reproduce the request directly.
   - Start the repository's existing PHP server command, or use `php -S 127.0.0.1:8000 -t <document-root>` when appropriate.
   - Test GET and the relevant POST/PUT request with `curl`.
   - Inspect the complete status, headers, and raw response body before changing parsing code.
3. Find the HTML source.
   - Treat `<br />`, `<b>Warning`, `<b>Notice`, and `<b>Fatal error` as PHP diagnostics leaking into the response.
   - Check missing files/classes, wrong constructor arguments, undefined variables, invalid array access, calling arrays as functions, and malformed JSON input.
4. Fix the server response at its source.
   - Ensure all successful and error paths return JSON only.
   - Set `Content-Type: application/json; charset=utf-8`.
   - Use appropriate HTTP status codes and a structured error such as `{"error":"..."}`.
   - Validate decoded request data before using it.
   - Do not hide errors with a broad silent catch or make the frontend accept HTML as success.
5. Keep the frontend robust.
   - Read the response body once, parse JSON explicitly, and show a useful error when the body is not valid JSON or the status is not successful.
   - Preserve the existing UI behavior for successful responses.
6. Validate the fix.
   - Run `php -l` on every changed PHP file.
   - Exercise the endpoint with GET and the relevant write request.
   - Confirm valid JSON, expected status codes, and no PHP diagnostic markup.
   - Remove any records created only for testing and stop temporary servers.
   - Run the smallest relevant project checks and `git diff --check`.

## Common Root Causes

- A required PHP file does not exist or has the wrong path/casing.
- PHP warnings or fatal errors are printed before `json_encode`.
- Request data is accessed incorrectly, for example `$data('name')` instead of `$data['name']`.
- Response field names differ between PHP and JavaScript.
- The endpoint returns an HTML error page for a non-2xx response.
- The frontend calls `response.json()` without checking the status or handling malformed bodies.

## Completion Criteria

The endpoint must return JSON on success and failure, with no HTML diagnostics mixed into the body. The frontend must display the API error instead of exposing a JSON parser exception, and the original successful flow must remain functional.
