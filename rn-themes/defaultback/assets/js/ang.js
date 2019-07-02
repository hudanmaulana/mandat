function save_ang(action,moduler, controller,url,base_url) {
    var app = angular.module( moduler, ['ngSanitize']);
    app.controller(controller,function($scope, $http)
    {
        $scope[action] = function (redirect=true) {
            var formDataArray = $('#'+action).serializeArray();
            var formData = {};
            formDataArray.forEach(function(entry) {
                formData[entry.name]=entry.value;
            });
            $http({
                url: base_url+"/"+url,
                method: "POST",
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                data: formData
            }).then(function successCallback(response) {
                var result = response.data;
                if( result.status === 'success'){
                    alertify.success(result.message);
                    if (typeof result.callback_url !== "undefined") {
                        document.getElementById("form").reset();
                        if( redirect ) window.location = result.callback_url;
                    }
                }else if( result.status === 'error'){
                    alertify.error(result.message);
                    if (typeof result.callback_url !== "undefined") {
                        document.getElementById("form").reset();
                        if( redirect ) window.location = result.callback_url;
                    }
                }
                else {
                    $.each(result.message,  function(key, val) {
                        // alertify.error(val);
                        var notifi = alertify.notify(val, 'success', 5, function(){  console.log('dismissed'); });
                    });
                }
            }, function errorCallback(response) {
                console.log(response);
                alertify.alert('Oops error, please refresh this page');
            });
        };
    });
};


