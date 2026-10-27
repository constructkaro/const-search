const {chromium}=require('C:/Users/ANIKET PATIL/.cache/codex-runtimes/codex-primary-runtime/dependencies/node/node_modules/playwright');
(async()=>{
 const browser=await chromium.launch({headless:true,executablePath:'C:/Program Files/Google/Chrome/Application/chrome.exe'});
 const page=await browser.newPage();
 for(const width of [1440,1024,390]) {
  await page.setViewportSize({width,height:1000});
  const response=await page.goto('http://127.0.0.1:8087/end-to-end-plotting-development',{waitUntil:'networkidle'});
  await page.locator('.plot-page img').evaluateAll(images=>images.forEach(img=>img.loading='eager'));
  await page.waitForFunction(()=>[...document.querySelectorAll('.plot-page img')].every(img=>img.complete));
  console.log(JSON.stringify({width,status:response.status(),...await page.evaluate(()=>({title:document.title,h1:document.querySelector('h1')?.innerText,overflow:document.documentElement.scrollWidth>innerWidth,broken:[...document.querySelectorAll('.plot-page img')].filter(i=>!i.complete||!i.naturalWidth).map(i=>i.src),headerOverflow:document.querySelector('.header .container').scrollWidth>document.querySelector('.header .container').clientWidth,enquiry:document.querySelector('.plot-btn')?.href}))}));
  await page.screenshot({path:`tmp/plotting-${width}.png`,fullPage:true});
  if(width===390){await page.locator('#menuToggleBtn').click();console.log('Mobile nav visible:',await page.locator('#mainNav a[href$="end-to-end-plotting-development"]').isVisible());}
 }
 const home=await page.goto('http://127.0.0.1:8087/',{waitUntil:'domcontentloaded'});console.log('Home:',home.status(),'promo links:',await page.locator('.ck-plot-promo-btn').count());
 await browser.close();
})().catch(e=>{console.error(e);process.exit(1)});
