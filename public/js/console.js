var ApiConsole = (function () {

    var ApiConsole = {};

    ApiConsole.init = function () {
        console.log('%c Have a nice day :)', 'color: gold; display: block; font-size: 15pt;');
        ApiConsole.keyValues.init();
        var sendButtons = document.getElementsByClassName('send');
        for (var i = 0; i < sendButtons.length; i++) { sendButtons[i].addEventListener('click', ApiConsole.send); }
        document.getElementsByClassName('method')[0].addEventListener('click', methodClicked);

        ApiConsole.demos.init();
    };

    /**
     * Load a configuration into the console.
     * @param {Object} obj 
     */
    ApiConsole.load = function (obj) {
        console.log(obj);
        ApiConsole.setUrl(obj.url);
        ApiConsole.setMethod(obj.method);
        ApiConsole.keyValues.set(obj.data);
    };

    /**
     * Set the url
     * @param {String} url 
     */
    ApiConsole.setUrl = function (url) {
        document.getElementsByClassName('url')[0].value = url;
    };

    /**
     * Get the url.
     * @returns {String} url
     */
    ApiConsole.getUrl = function () {
        return document.getElementsByClassName('url')[0].value;
    };

    /**
     * Set the method.
     * @param {String} method.
     */
    ApiConsole.setMethod = function (method) {
        document.getElementsByClassName('method')[0].value = method;
    };

    /**
     * Get the method.
     * @returns {String} method
     */
    ApiConsole.getMethod = function () {
        return document.getElementsByClassName('method')[0].value;
    };

    /**
     * Method button clicked.
     * @param {Object} ev 
     */
    function methodClicked(ev) {
        // If the user clicks on the arrow, remove the current value, so the suggestions will be shown
        if (ev.target.getBoundingClientRect().width - ev.layerX < 32) {
            ev.target.value = "";
        }

    }

    /**
     * Send request!
     */
    ApiConsole.send = function () {
        var url = ApiConsole.getUrl();
        var method = ApiConsole.getMethod().toUpperCase();
        var data = ApiConsole.keyValues.get();
        if (method == 'GET') {
            url = url + "?" + Object.keys(data).map(
                function (k) { return encodeURIComponent(k) + '=' + encodeURIComponent(data[k]) }
            ).join('&');
        }
        ApiConsole.performRequest(method, url, data, requestDone)

    }

    /**
     * Called when a request is done.
     * @param {Object} response 
     */
    function requestDone(response) {
        var statusElem = document.getElementsByClassName('httpstatus')[0];
        if (response.status == 200) {
            statusElem.classList.remove('error');
            statusElem.classList.add('success');
        } else {
            statusElem.classList.add('error');
            statusElem.classList.remove('success');
        }
        statusElem.innerHTML = "HTTP Status " + response.status;
        try{
            document.getElementsByClassName('result')[0].innerHTML = syntaxHighlight(JSON.parse(response.response));
        }
        catch(ex){
            document.getElementsByClassName('result')[0].innerHTML = response.response;
        }
        
    }

    /*
     * Key value pairs input.
     */
    ApiConsole.keyValues = {};

    /**
     * Initialize key-value input fields
     */
    ApiConsole.keyValues.init = function () {
        // add button
        var addButton = document.getElementsByClassName('add-key-value')[0];
        addButton.addEventListener('click', ApiConsole.keyValues.add);
        // delete buttons
        var deleteButtons = document.getElementsByClassName('delete-key-value');
        for (var i = 0; i < deleteButtons.length; i++) {
            deleteButtons[i].addEventListener('click', ApiConsole.keyValues.delete)
        }
    };


    ApiConsole.keyValues.set = function (data) {
        document.getElementsByClassName('keyvalues')[0].innerHTML = '';
        for (var key in data) {
            if (data.hasOwnProperty(key)) {
                ApiConsole.keyValues.add(key, data[key]);
            }
        }
    };

    ApiConsole.keyValues.get = function () {
        var elements = document.getElementsByClassName('keyvalues')[0].getElementsByClassName('form-input');
        var result = {};
        for (var i = 0; i < elements.length; i++) {
            var key = elements[i].getElementsByClassName('key')[0].value;
            var value = elements[i].getElementsByClassName('value')[0].value;
            result[key] = value;
        }
        return result;
    }

    /**
     * Delete this key-value pair
     */
    ApiConsole.keyValues.delete = function (ev) {
        var target = ev.target.parentNode;
        target.parentNode.removeChild(target);
    }

    /**
     * Add a key-value pair. 
     */
    ApiConsole.keyValues.add = function (key, value) {
        /*
        <div class="form-input">
            <input class="key" type="text" id="key" placeholder="Key">
            <input class="value" type="text" id="key" placeholder="Value">
            <button class="delete">&#9587;</button>
        </div>
        */
        var container = document.createElement('div');
        container.className = 'form-input';
        var input = document.createElement('input');
        input.className = "key";
        input.type = "text";
        input.placeholder = "Key";
        if (typeof key == 'string') {
            input.value = key;
        }

        container.appendChild(input);
        input = document.createElement('input');
        input.className = "value";
        input.type = "text";
        input.placeholder = "Value";
        if (typeof value == 'string') {
            input.value = value;
        }

        container.appendChild(input);
        var button = document.createElement('button');
        button.className = 'delete-key-value';
        button.innerHTML = "&#9587;"; // x
        container.appendChild(button);
        document.getElementsByClassName('keyvalues')[0].appendChild(container);
        button.addEventListener('click', ApiConsole.keyValues.delete);
    };

    ApiConsole.demos = {};
    

    ApiConsole.demos.init = function () {
        var elem = document.getElementsByClassName('demo')[0];
        elem.innerHTML = "<h1>Demo</h1>";
        for (var key in ApiConsole.demos.demos) {
            if (ApiConsole.demos.demos.hasOwnProperty(key)) {
                var demos = ApiConsole.demos.demos[key];
                var h2 = document.createElement('h2');
                h2.innerHTML = key;
                elem.appendChild(h2);
                var row = document.createElement("div");
                row.className = "row";
                var list = document.createElement('ul');
                list.className = 'list';

                for (var key in demos) {
                    if (demos.hasOwnProperty(key)) {
                        var listItem = document.createElement('li');
                        listItem.innerHTML = key;
                        var button = document.createElement('button');
                        button.className = 'demo';
                        button.innerHTML = '&rarr;';
                        listItem.addEventListener('click', ApiConsole.demos.loadDemo.bind(undefined, demos[key]));
                        listItem.appendChild(button);
                        list.appendChild(listItem);
                    }
                }
                row.appendChild(list);
                elem.appendChild(row);



            }
        }
    }

    ApiConsole.demos.loadDemo = function (demo) {
        ApiConsole.load(demo);
    }


    ApiConsole.performRequest = function (method, url, data, callback) {
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
    };

    /**
     * Simple syntax highlighter. 
     * https://stackoverflow.com/questions/4810841/how-can-i-pretty-print-json-using-javascript
     * @param {Mixed} json 
     */
    function syntaxHighlight(json) {
        if (typeof json != 'string') {
            json = JSON.stringify(json, undefined, 2);
        }
        json = json.replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;');
        return json.replace(/("(\\u[a-zA-Z0-9]{4}|\\[^u]|[^\\"])*"(\s*:)?|\b(true|false|null)\b|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?)/g, function (match) {
            var cls = 'number';
            if (/^"/.test(match)) {
                if (/:$/.test(match)) {
                    cls = 'key';
                } else {
                    cls = 'string';
                }
            } else if (/true|false/.test(match)) {
                cls = 'boolean';
            } else if (/null/.test(match)) {
                cls = 'null';
            }
            return '<span class="' + cls + '">' + match + '</span>';
        });
    }

    /**
     * API Console demos
     */
    ApiConsole.demos.demos = {
        "Authentication": { 
            "Register user": {"url": "/api/auth/register", "method": "POST", "data": {"email": "test@example.com", "password": "password"}},
            "Get access token": { "url": "/api/auth/gettoken", "method": "POST", "data": {'email': 'test@bartjakobs.nl', 'password': 'test'}},
            "Get user info": { "url": "/api/auth/getuser", "method": "POST", "data": { 'token': 'JWT access token' } } 
        },
        "Trees": {
            "List this users' trees": {
                "url": "/api/trees", "method": "GET", "data": {'token': "JWT access token"}
            },
            "Register a new tree": {
                "url": "/api/trees", "method": "POST", "data": { 'token': "JWT access token", 'name': "oh christmas tree", 'location': "Den Bosch", 'ison': false, 'decorations': 30}
            },
            "Modify an existing tree": {
                "url": "/api/trees/5", "method": "POST", "data": { 'token': "JWT access token", 'ison': "true", 'decorations': "25" }
            },
            "Delete a tree": {
                "url": "/api/trees/5", "method": "DELETE", "data": { 'token': "JWT access token" }
            }
        },
        "Statistics" : { 
            "Get all availabale statistics": {
                "url": "/api/public/statistics", "method": "GET", "data": {}
            }
        }
        
    };

    return ApiConsole;
})();

window.addEventListener('load', ApiConsole.init);