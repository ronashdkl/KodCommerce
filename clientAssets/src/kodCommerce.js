/*
(c) Ronash Dhakal
 */

export default (function(alertify){
    var config = {};

    /**
     * API
     * @param endpoint
     * @param data
     * @returns {Promise<Response>}
     */
  var api =  function (endpoint, data = null) {
        var apiurl = config.controller + "/";

        var url = apiurl + endpoint;

        if (data) {

            return  fetch(url, {
                method: 'POST', // *GET, POST, PUT, DELETE, etc.
                mode: 'same-origin', // no-cors, *cors, same-origin
                cache: 'no-cache', // *default, no-cache, reload, force-cache, only-if-cached
                credentials: 'same-origin', // include, *same-origin, omit
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-Token': document.querySelector("input[name='_csrf']").value,
                    //'Content-Type': 'application/x-www-form-urlencoded',
                },
                redirect: 'follow', // manual, *follow, error
                referrerPolicy: 'no-referrer', // no-referrer, *no-referrer-when-downgrade, origin, origin-when-cross-origin, same-origin, strict-origin, strict-origin-when-cross-origin, unsafe-url
                body: JSON.stringify(data) // body data type must match "Content-Type" header
            })

        } else {
            return  fetch(url);
        }

    }

    /**
     * Public method
     * @param endpoint
     * @param data
     * @returns {Promise<Response>}
     */
    var client = function (endpoint, data) {
        return api(endpoint, data)
            .then(response => {
                const contentType = response.headers.get('content-type');
                if (!contentType || !contentType.includes('application/json')) {
                    throw new TypeError("Application Error");
                }
                switch (response.status) {
                    case 200:
                        return response.json();
                    case 422:
                        return response.json().then(x => {
                            throw new TypeError(x);
                        })

                    default:
                        throw new TypeError(response.statusText);
                }

            })

    }
    return {
        init: function(developerConifg){
          Object.assign(config,developerConifg)
        },
      client,

        /**
         * Notification Module
         */
        Notification: (function (engine) {

            var success = function (msg) {
                return engine.success(msg)
            }
            var warning = function (msg) {
                return engine.warning(msg);
            }
            var error = function (msg) {
                return engine.error(msg);
            }
            var dismissAll = function () {
                setTimeout(function () {
                    engine.dismissAll();
                }, 1000);
            }

            var confirm = function (msg, onSuccess, onReject) {
                engine.confirm('Warning!', msg,
                    onSuccess,
                    onReject);

            }
            return {
                confirm,
                notify: {
                    success,
                    warning,
                    error,
                    dismissAll
                }
            }
        })(alertify)
    }
});

