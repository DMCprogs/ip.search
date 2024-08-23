document.querySelector('.ip-input').addEventListener('input', function (event) {
    // Регулярное выражение, которое разрешает только цифры и точки
    const regexp = /^[0-9.]*$/;
    // Получение текущего значения поля ввода
    const value = this.value;
    // Если значение не соответствует регулярному выражению, удаляем последний символ
    if (!regexp.test(value)) {
        this.value = value.slice(0, -1);
    }
});
var ipsearch = {
};

ipsearch.init = function (params) {
    let frontfile = params.frontfile;
    let idHigload = params.idHigload;
    let ipServic = params.ipServic;
    let button = document.querySelector(".ajax-btn");
    let textInfo = document.querySelector(".textarea-logs");
    let ip = document.querySelector(".ip-input");
    let errorDiv = document.querySelector(".text-danger");
    button.onclick = function (element) {

        if (ip.value != "") {
            $.ajax({
                url: frontfile + '/getData.php',
                method: 'post',
                dataType: 'json',
                data: { IP: ip.value, ID: idHigload, SERVIC: ipServic, TYPE: "search" },
                success: function (data) {
                    switch (data) {
                        case "OPTION_1":
                            $.ajax({
                                url: 'https://api.sypexgeo.net/json/' + ip.value,
                                method: 'GET',
                                success: function (data) {

                                    if (data.city === "") {
                                        // Обработка случая, когда "success": false

                                        errorDiv.textContent = "Ошибка в данных sypexgeo: " + data.error.type;
                                    } else {
                                        errorDiv.textContent="";
                                        textInfo.value = JSON.stringify(data, null, 2);
                                        $.ajax({
                                            url: frontfile + '/getData.php',
                                            method: 'POST',
                                            dataType: 'json',
                                            data: { IP: data.ip, ID: idHigload, IP_INFO: JSON.stringify(data, null, 2), TYPE: "add" },
                                            success: function (data) {

                                            },
                                            error: function (jqXHR, textStatus, errorThrown) {

                                                errorDiv.textContent = "Ошибка при запросе данных:" + textStatus;
                                            }
                                        });
                                    }
                                },
                                error: function (jqXHR, textStatus, errorThrown) {
                                    errorDiv.textContent = "Ошибка при запросе данных:" + textStatus;
                                }
                            });
                            break;
                        case "OPTION_2":
                            $.ajax({
                                url: 'https://api.ipstack.com/' + ip.value + '?access_key=b91be80638dd901ff115efaceae00cd8',
                                dataType: 'json',
                                success: function (data) {
                                    if (data.success === false) {
                                        // Обработка случая, когда "success": false
                                        console.log("kek");
                                        errorDiv.textContent = "Ошибка в данных ipstack: " + data.error.type;
                                    } else {
                                        console.log("kek");
                                        errorDiv.textContent="";
                                        textInfo.value = JSON.stringify(data, null, 2);
                                        $.ajax({
                                            url: frontfile + '/getData.php',
                                            method: 'POST',
                                            dataType: 'json',
                                            data: { IP: data.ip, ID: idHigload, IP_INFO: JSON.stringify(data, null, 2), TYPE: "add" },
                                            success: function (data) {

                                            },
                                            error: function (jqXHR, textStatus, errorThrown) {
                                                errorDiv.textContent = "Ошибка при запросе данных:" + textStatus;
                                            }
                                        })
                                    }
                                },
                                error: function (jqXHR, textStatus, errorThrown) {
                                    errorDiv.textContent = "Ошибка при запросе данных:" + textStatus;
                                }
                            });
                            break;
                        default:
                            console.log(data.status);
                            if(data.status==="error"){
                                textInfo.value="";
                                errorDiv.textContent = data.data;
                            }
                            else{
                                errorDiv.textContent="";
                                textInfo.value = data.data;
                            }
                           
                            break;
                    }

                }
            });
        }

    }

}