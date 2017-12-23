@extends("welcome")

@section('head')
<script src="/js/console.js"></script>
 <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f; 
                font-family: 'Source Sans Pro', sans-serif;
                font-weight: 300;
                height: 100vh;
                margin: 0;
            }
            .container{ 
                position: relative;
                margin: 0 auto;
                top: 40px;
                max-width: 1000px;      
                
            }
            .window { 
                position: relative;
                display: inline-block;
                padding: 10px;
                box-shadow: 0px 0px 3px 0px rgba(99,107,111,0.3);
                vertical-align: top; 
                margin: 10px;
            }
            .apiconsole {
                width: 660px;
                height: 100%;
                
            }
            .demo {
                width: 240px;
            }
            h1 {
                font-size: 35px;
                position: relative;      
                margin: 10px;
                text-align: center;
                font-weight: inherit;
            }
            h1:before {
                content : "";
                position: absolute;
                left    : 0;
                bottom  : 0;
                height  : 1px;
                width   : 100%;  /* or 100px */
                border-bottom:1px solid rgba(99,107,111,0.3);
            }
            hr {
                border: none;
                border-bottom:1px solid rgba(99,107,111,0.3);
                height: 1px;
            }
            h2 { 
                text-transform: uppercase;
                margin: 10px 0;
                padding: 0;
                font-size: 15px;
                font-weight: 600;
            }
            .contents {
                padding-top: 15px;
                margin: 10px;
            }
            .form-input {
                width: 100%;
                display:table;
                position: relative;
                box-sizing: border-box;
                font-size: 21px;
                padding-bottom: 3px;     
            }
            .form-input input, .form-input button {
                font-size: inherit;
                display:table-cell;
                vertical-align:middle;
                box-sizing: border-box;
                font-family: inherit;
                margin: 5px;
            }
            .form-input input.key {
                width: 40%;
                border-color: rgba(0,0,0,0);
            }

            .form-input input.key:selected {
                border: initial;
            }
            .form-input input.value {
                width: 50%;
                margin-left: 10px;
            }
            .form-input button { 
                box-shadow: 0px 0px 3px 0px rgba(99,107,111,0.3);
            }
            .row {
                min-height: 24px;
                padding-bottom: 9px;
            }
            .pull-right {
                float: right;
                padding: 10px;
            }
            .form-input button.delete-key-value {
                display:table-cell;
                vertical-align: middle;
                align: right;
                height: 21px;
                width: 21px;
                border-radius: 50%;
                font-size: 8px;
                margin: 0; 
                padding: 0;
                padding-left: -1px;
                padding-top: 2px;
                margin-left: 15px;
                outline: none;
                color: rgba(210,50,30,1);
            }
            .center { 
                text-align: center;
                width: 100%;
            }
            .form-input button.btn {
                color: rgba(99,107,111,0.9);
                border: none;
                font-size: 21px;
                font-family: inherit;
            }
            .form-input input.method {
                width: 20%;
            }
            .form-input input.url {
                width: 65%;
            }
            .form-input button.send {
                width: 10%;
                background-color: white;
                border: none;
            }
            .result {
                min-height: 40px;
                font-family: "Fira Code";
                font-weight: normal;
                outline: 1px solid #ccc; 
                padding: 5px; 
                margin: 5px; 
                overflow-x: scroll;
            }
            .httpstatus {
                float: right;
            }
            .httpstatus.success  {
                color: darkgreen;
            }
            .httpstatus.error  {
                color: darkred;
            }
            

            .string { color: darkgreen; }
            .number { color: darkorange; }
            .boolean { color: blue; }
            .null { color: magenta; }
            .key { color: darkred; }

            ul.list {
                list-style: none;
                padding: 0;
                border: 1px solid rgba(99,107,111,0.3);
                border-radius: 4px;
            }
            ul.list li {
                padding: 2px;
                border-bottom:  1px solid rgba(99,107,111,0.3);
            }
            ul.list li:last-child {
                border-bottom: none;
            }
            ul.list li button {
                float: right;
                width: auto;
                border: none;
                box-shadow: none;
                height: 100%;
                font-size: inherit;
                font-family: inherit;
                font-weight: 600;
                margin-top: -2px;
                margin-bottom: 0;
                margin-right: 0;

            }
            
        </style>
@endsection

@section('body')
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
@endsection