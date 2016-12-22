$(document).ready(function () {
    $('.clockpicker').clockpicker();
});

var dataPicker = $('#datepicker');

var checkMaster = $('.checkMaster');
var checkService = $('.checkService');
var checkTime = $('.checkTime');
var service = $('.service');
var subscribe = $('.subscribe');

var backService = $('.backService');
var backTime = $('.backTime');
var backPay = $('.backPay');

var masterPanel = $('#masterPanel');
var servicePanel = $('#servicePanel');
var timePanel = $('#timePanel');
var payPanel = $('#payPanel');

var total = $('#total');

var employee;
var employeeName;
var time;
var services = [];

backService.click(function () {
    masterPanel.show();
    servicePanel.hide();
});

backTime.click(function () {
    servicePanel.show();
    timePanel.hide();
});

backPay.click(function () {
    timePanel.show();
    payPanel.hide();
});

checkService.hide();

checkMaster.click(function () {
    employee = $(this).data("employee");
    employeeName = $(this).data("employee-name");
    masterPanel.hide();
    servicePanel.show();
    return false;
});

checkService.click(function () {
    servicePanel.hide();
    initTimes(dataPicker);
    timePanel.show();
});

service.click(function () {

    var serviceId = $(this).data('service');
    var serviceName = $(this).data('service-name');
    var serviceCost = $(this).data('service-cost');

    var item = {};
    item.id = serviceId;
    item.name = serviceName;
    item.cost = serviceCost;

    if ($(this).hasClass('active')) {
        $(this).removeClass('active');
        delete services[serviceId];
    } else {
        $(this).addClass('active');
        services[serviceId] = item;
    }

    var count = 0;
    services.forEach(function () {
        count++;
    });

    if (count > 0) {
        checkService.show();
    } else {
        checkService.hide();
    }

});

checkTime.click(function () {
    timePanel.hide();

    var inputs = $('#payment-form');
    var servHtml = '';
    var cost = 0;

    inputs.append('<input type="hidden" name="employee" value="' + employee + '">');
    inputs.append('<input type="hidden" name="time" value="' + time + '">');

    services.forEach(function (item) {
        servHtml += item.name + ', ';
        cost += item.cost;
        inputs.append('<input type="hidden" name="services[]" value="' + item.id + '">');
    });

    servHtml = servHtml.substring(0, servHtml.length - 2);
    cost = (Math.round(cost * 100) / 100);

    total.html(
        "<p><strong>Мастер:</strong> " + employeeName + "</p>" +
        "<p><strong>Время:</strong> " + time + "</p>" +
        "<p><strong>Услуги:</strong> " + servHtml + "</p>" +
        "<p><strong>Стоимость:</strong> " + cost + "</p>"
    );

    payPanel.show();
});

function setTime(item) {
    time = item.val();
}

function initTimes(dataPicker) {
    $.ajax({
        method: 'get',
        url: '/api/times?&employee=' + employee,
        async: false
    }).done(function (data) {
        if (data) {
            data = data.replace(/\\n/g, "\n")
                .replace(/\\'/g, "\'")
                .replace(/\\"/g, '\"')
                .replace(/\\&/g, "\&")
                .replace(/\\r/g, "\r")
                .replace(/\\t/g, "\t")
                .replace(/\\b/g, "\b")
                .replace(/\\f/g, "\f");

            var timesValues = JSON.parse(data);
            initCalendar(dataPicker, timesValues);
        }
    });
}

function initCalendar(dataPicker, timeVar) {

    var timesValues = timeVar.times ? timeVar.times : {};
    var bookingTimes = timeVar.bookingTimes ? timeVar.bookingTimes : [];

    var times = [];
    var access = [];
    for (var _date in timesValues) {
        if (!timesValues.hasOwnProperty(_date)) continue;

        if (timesValues[_date].day) {
            access.push(_date);
        }
    }

    dataPicker.datepicker('destroy');
    dataPicker.datepicker({
        monthNames: ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'],
        dayNamesMin: ['Вс', 'Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб'],
        firstDay: 1,
        dateFormat: "dd.mm.yy",
        altField: "#alternate",
        showOtherMonths: true,
        selectOtherMonths: true,
        beforeShowDay: function (date) {
            if (access.length == 0) return [false, ''];

            var dd = date.getDate();
            var mm = date.getMonth() + 1; //January is 0!
            var yyyy = date.getFullYear();
            var dateObj = new Date(yyyy, mm - 1, dd);
            var dayWeek = ["Вс", "Пн", "Вт", "Ср", "Чт", "Пт", "Сб"][dateObj.getDay()];

            dd = (dd < 10) ? '0' + dd : dd;
            mm = (mm < 10) ? '0' + mm : mm;

            var currentDate = dd + '.' + mm + '.' + yyyy;


            if ((access.indexOf('Пн')) > -1 && dayWeek == 'Пн') {
                times[dd + '.' + mm + '.' + yyyy] = timesValues['Пн'];
                return [true, ''];
            }

            if ((access.indexOf('Вт')) > -1 && dayWeek == 'Вт') {
                times[dd + '.' + mm + '.' + yyyy] = timesValues['Вт'];
                return [true, ''];
            }

            if ((access.indexOf('Ср')) > -1 && dayWeek == 'Ср') {
                times[dd + '.' + mm + '.' + yyyy] = timesValues['Ср'];
                return [true, ''];
            }

            if ((access.indexOf('Чт')) > -1 && dayWeek == 'Чт') {
                times[dd + '.' + mm + '.' + yyyy] = timesValues['Чт'];
                return [true, ''];
            }

            if ((access.indexOf('Пт')) > -1 && dayWeek == 'Пт') {
                times[dd + '.' + mm + '.' + yyyy] = timesValues['Пт'];
                return [true, ''];
            }

            if ((access.indexOf('Сб')) > -1 && dayWeek == 'Сб') {
                times[dd + '.' + mm + '.' + yyyy] = timesValues['Сб'];
                return [true, ''];
            }

            if ((access.indexOf('Вс')) > -1 && dayWeek == 'Вс') {
                times[dd + '.' + mm + '.' + yyyy] = timesValues['Вс'];
                return [true, ''];
            }

            if (access.indexOf(currentDate) > -1) {
                times[dd + '.' + mm + '.' + yyyy] = timesValues[currentDate];
                return [true, ''];
            } else {
                return [false, ''];
            }
        },
        onSelect: function (dateText) {
            $('.h-pull-right').hide();
            var datapickerTimeBlock = $('#datapicker-time');

            datapickerTimeBlock.html('');

            var time = times[dateText];
            var start = new Date(dateText.replace(/(\d+).(\d+).(\d+)/, '$2/$1/$3') + ' ' + time.start);
            var end = new Date(dateText.replace(/(\d+).(\d+).(\d+)/, '$2/$1/$3') + ' ' + time.end);

            var breakCount = 48;
            var current = start;
            while (current <= end) {
                var currentStrTime = ((current.getHours() < 10) ? '0' + current.getHours() : current.getHours())
                    + ':' + ((current.getMinutes() < 10) ? '0' + current.getMinutes() : current.getMinutes());
                var dd = current.getDate();
                var mm = current.getMonth() + 1;
                var yyyy = current.getFullYear();
                dd = (dd < 10) ? '0' + dd : dd;
                mm = (mm < 10) ? '0' + mm : mm;
                var value = dd + '.' + mm + '.' + yyyy + ' ' + currentStrTime;

                Array.prototype.in_interval = function (p_val) {
                    for (var i = 0, l = this.length; i < l; i++) {
                        if (this[i]['start'] <= p_val && this[i]['end'] >= p_val) {
                            console.log(this[i]['start']);
                            console.log(this[i]['end']);
                            return true;
                        }
                    }
                    return false;
                };

                if (!bookingTimes.in_interval(value)) {
                    datapickerTimeBlock.html(datapickerTimeBlock.html() + '<label><input onclick="$(\'.h-pull-right\').show();setTime($(this))" type="radio" name="time" value="' + value + '"><span>' + currentStrTime + '</span></label>');
                }

                current.setMinutes(current.getMinutes() + 30);

                if (breakCount-- < 0) break;
            }

            datapickerTimeBlock.show();
        }
    });
}
