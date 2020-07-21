const puppeteer = require('puppeteer');

const getStats = async (url, name, point, rank) => {
    const browser = await puppeteer.launch({headless: true});
    const page = await browser.newPage();
    await page.setUserAgent('Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.77 Safari/537.36');
    await page.goto(url, { waitUntil: 'networkidle0' }); //https://www.hackerrank.com/contests/practice-7-sda/leaderboard/1
    const score = await page.evaluate((name, rank, point) => {

        const selectData = (selector) => {
            const response = Array.from(document.body.querySelectorAll(selector));
            const result = response.map(r => {
                return r.innerText;
            });

            return result;
        };

        const points = selectData(point); // .leaderboard > .table-wrap > #leaders > .leaderboard-list-view > .leaderboard-row > .span-flex-3 > p
        const names = selectData(name); // .leaderboard > .table-wrap > #leaders > .leaderboard-list-view > .leaderboard-row > .span-flex-4 > p
        const ranks = selectData(rank); // .leaderboard > .table-wrap > #leaders > .leaderboard-list-view > .leaderboard-row > .text-center > p

        return {points, names, ranks};
    }, name, rank, point);
    browser.close();
    const users = [];
    for(let i = 0; i < score.names.length; i++){
        users.push({
            name: score.names[i],
            points: score.points[i],
            ranks: score.ranks[i]
        })
    }
    return JSON.stringify(users);
}

const main = async () => {
    const args = process.argv;
    const parserConfig = {};
    try{
        for(let i = 0; i < args.length; i++){
            if(args[i] === '--url' || args[i] === '-url' || args[i] === '-u') {
                parserConfig['url'] = args[i + 1];
            }
            else if(args[i] === '--name' || args[i] === '-name' || args[i] === '-n'){
                parserConfig['name'] = args[i + 1];
            }else if(args[i] === '--points' || args[i] === '-points' || args[i] === '-p'){
                parserConfig['points'] = args[i + 1];
            }else if(args[i] === '--rank' || args[i] === '-rank' || args[i] === '-r'){
                parserConfig['rank'] = args[i + 1];
            }
        }
    } catch(err){
        console.log(`Wrong usage, the script allows following parametars:
            --url, -url, -u for setting path for url
            --name, -name, -n for setting path for name
            --points, -points, -p for setting path for points
            --rank, -rank, -r for setting path for ranks
        `);
    }
    const stats = await getStats(parserConfig['url'], parserConfig['name'], parserConfig['points'], parserConfig['rank']);
    console.log(stats);
    return stats;
}

main();
