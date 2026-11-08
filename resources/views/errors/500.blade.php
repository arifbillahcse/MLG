{{--
  Deliberately standalone: no @extends, no view composers, no database.
  A 500 is often caused by the database being unreachable, and the layout's
  ChromeComposer queries settings and the nav — rendering it here would throw
  a second time and leave the visitor a blank page.
--}}
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Something went wrong — Multi Languages Gateway</title>
<style>
  :root{--ink:#0D1B3E;--red:#D3372B;--slate:#5A6478;--paper:#F5F6FA;--line:#DDE2EC}
  *{box-sizing:border-box}
  body{
    margin:0;min-height:100vh;display:grid;place-items:center;
    background:var(--paper);color:var(--ink);
    font-family:"Hind Siliguri","Segoe UI",Roboto,-apple-system,sans-serif;
    padding:24px;
  }
  .box{max-width:30rem;text-align:center}
  .code{
    font-size:12px;font-weight:700;letter-spacing:.12em;text-transform:uppercase;
    color:var(--red);margin:0 0 12px;
  }
  h1{font-size:clamp(24px,5vw,32px);line-height:1.2;margin:0 0 12px}
  p{color:var(--slate);line-height:1.65;margin:0 0 28px}
  a{
    display:inline-block;background:var(--red);color:#fff;text-decoration:none;
    font-weight:600;padding:13px 26px;border-radius:10px;
  }
  a:focus-visible{outline:3px solid var(--ink);outline-offset:3px}
</style>
</head>
<body>
  <div class="box">
    <p class="code">500</p>
    <h1>Something went wrong at our end</h1>
    <p>This is our fault, not yours. Please try again in a moment — if you were in the middle of sending an enquiry, call us instead and we will take the details.</p>
    <a href="/">Back to the homepage</a>
  </div>
</body>
</html>
