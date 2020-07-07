const getLeaderboard = async () => {
    const leaderboard = await fetch('https://www.hackerrank.com/contests/practice-1-sda/leaderboard', {
        mode: 'no-cors',
        headers: {
            'Content-Type': 'text/html',
            'Access-Control-Allow-Origin': '*',
            // 'Content-Type': 'application/x-www-form-urlencoded',
        },
    });
    const res = await leaderboard.text();
    console.log(res);
}

getLeaderboard();