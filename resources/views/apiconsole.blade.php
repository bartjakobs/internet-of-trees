<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Api</title>
        
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.rawgit.com/tonsky/FiraCode/1.204/distr/fira_code.css">
    <script src="/js/console.js"></script>  
    <!-- Styles -->
    <link rel="stylesheet" href="/css/console.css" type="text/css">
    </head>
    <body>
        <div class="container">
            <div class="window demo">
                <h1>Demo</h1>
            </div>

            <div class="window apiconsole">
                <h1 class="title">
                    Barts API Console
                </h1>
                <div class="contents">
                    <h2>Url</h2>   
                    <div class="row">
                        <div class="form-input">
                            <input type="text" class="method" name="method" value="GET" list="methods">
                            <datalist id="methods">
                                <option value="GET">
                                <option value="POST">
                                <option value="PUT">
                                <option value="DELETE">
                            </datalist>
                            <input class="url" type="text" value="api/test">
                            <button class="send">Send</button>
                        </div>
                    </div>
                    <h2>Data</h2>
                    <div class="row keyvalues">
                        <div class="form-input">
                            <input class="key" type="text" value="Key1" placeholder="Key">
                            <input class="value" type="text" value="Value1" placeholder="Value">
                            <button class="delete-key-value">&#9587;</button>
                        </div>

                    </div>
                    <div class="row">
                        <div class="form-input center">
                            <button class="btn add-key-value">Add key-value pair</button>
                        </div>
                    </div>
                    <hr>
                    <h2>Result <span class="httpstatus error">No request sent</span></h2>
                    <pre class="result">

                    </pre>
                </div>
            </div>
            
        </div>
    </body>
</html>
