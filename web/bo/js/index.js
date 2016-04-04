function createTrendsGraph(trends) {
    Morris.Line({
       element: "graph-trends",
       data:    trends,
       xkey:    'day',
       ykeys:   ['users', 'games'],
       labels:  ['Utilisateurs', 'Jeux'],
       smooth:  false,
       resize:  true,
       parseTime: false
    });
};

function createNewsGraph(news) {    
    Morris.Line({
       element: "graph-news",
       data:    news,
       xkey:    'day',
       ykeys:   ['users', 'games'],
       labels:  ['Utilisateurs', 'Jeux'],
       smooth:  false,
       resize:  true,
       parseTime: false
    });
};

function createGamesByPlateformGraph(games)
{
    Morris.Donut({
        element: 'graph-distri-games',
        data: games,
        resize: true
    });
};

function createPricesByPlateformGraph(prices)
{
    Morris.Donut({
        element: 'graph-distri-prices',
        data: prices,
        formatter: function(y, data) { return y + " €"; },
        resize: true
    });
};

function createPricesByDaysGraph(prices) 
{    
    Morris.Line({
       element: "graph-avg-prices",
       data:    prices,
       xkey:    'day',
       ykeys:   ['price'],
       yLabelFormat: function(y) { if(y !== undefined ) return y.toString() + ' €'; },
       labels:  ['Prix'],
       smooth:  false,
       resize:  true,
       parseTime: false
    });
};
