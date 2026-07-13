const puppeteer = require('puppeteer');

(async () => {
  const browser = await puppeteer.launch();
  const page = await browser.newPage();
  await page.goto('https://www.katieadamsonconservationfund.org/', {waitUntil: 'networkidle2'});

  const colors = await page.evaluate(() => {
    const getBg = (el) => window.getComputedStyle(el).backgroundColor;
    const getColor = (el) => window.getComputedStyle(el).color;
    
    // Attempt to find major elements
    const body = document.body;
    const header = document.querySelector('header');
    const buttons = Array.from(document.querySelectorAll('a, button')).filter(e => {
        const bg = getBg(e);
        return bg !== 'rgba(0, 0, 0, 0)' && bg !== 'transparent';
    });
    
    const palette = {
      bodyBg: getBg(body),
      bodyColor: getColor(body),
      headerBg: header ? getBg(header) : null,
      buttonBgs: [...new Set(buttons.map(b => getBg(b)))].slice(0, 3)
    };
    return palette;
  });

  console.log(JSON.stringify(colors, null, 2));
  await browser.close();
})();
