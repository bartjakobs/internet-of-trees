<html>
    <head>
        <title>Internet of Trees</title>
<link href="https://fonts.googleapis.com/css?family=Indie+Flower|Oswald" rel="stylesheet">

        <script>
            function request (method, url, data, callback) {
                var params = typeof data == 'string' ? data : Object.keys(data).map(
                    function (k) { return encodeURIComponent(k) + '=' + encodeURIComponent(data[k]) }
                ).join('&');

                var xhr = new XMLHttpRequest();

                xhr.open(method, url);
                xhr.onreadystatechange = function () {
                    if (xhr.readyState > 3) {
                        callback({ status: xhr.status, response: xhr.responseText })

                    }
                };
                xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                if (method != "GET") xhr.send(params);
                else xhr.send(null);
                return xhr;
            }

            window.addEventListener('load', function(){
                request('GET', '/api/public/statistics',{}, function(result){
                    
                    var results = JSON.parse(result.response);
                    document.getElementById('totalTrees').innerHTML = results.totalTrees;
                    document.getElementById('totalOn').innerHTML = results.totalOn;
                    document.getElementById('totalDecorations').innerHTML = results.totalDecorations;

                })
            })


        </script>
        <link rel="stylesheet" type="text/css" href="/css/home.css">
    </head>
    <body>
        <div class="container">
            <div class="menubar">
                <h1>Internet of Trees</h1>
            </div>

            <div class="row text">
                Counting all the Christmas Trees, the Internet of Trees is the worlds first online platform to measure Christmas Jolliness.
                Using a one-of-a-kind API, users and businessess can register their christmas trees and spread the christmassy love.
            </div>

            <div class="row stats">
               <p> <span id="totalTrees">5</span> christmas trees are registered</p><p><span id="totalOn">2</span> have burning candles</p><p><span id="totalDecorations">2</span> decorations in those trees.</p>

        </div>
    </body>
</html>
