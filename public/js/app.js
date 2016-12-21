$(function () {
    $(document).ready(function () {
        $('.clockpicker').clockpicker();
    });

    var dataPicker = $('#datepicker');

    var checkMaster = $('.checkMaster');
    var checkService = $('.checkService');

    var masterPanel = $('#masterPanel');
    var servicePanel = $('#servicePanel');
    var timePanel = $('#timePanel');
    var payPanel = $('#payPanel');

    var employee;

    checkMaster.click(function () {
        employee = $(this).data("employee");
        masterPanel.hide();
        servicePanel.show();
        return false;
    });

    checkService.click(function () {
        servicePanel.hide();
        initTimes(dataPicker);
        timePanel.show();
    });
    
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

                timesValues = JSON.parse(data);
            }
            initCalendar(dataPicker, timesValues);
        });
    }

    function initCalendar(dataPicker, timesValues) {

        timesValues = timesValues ? timesValues : {};

        var times = [];
        var access = [];
        for (var _date in timesValues) {
            if (!timesValues.hasOwnProperty(_date)) continue;
            access.push(_date);
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
            // beforeShowDay: function (date) {
            //     if (access.length == 0) return [false, ''];
            //
            //     var dd = date.getDate();
            //     var mm = date.getMonth() + 1; //January is 0!
            //     var yyyy = date.getFullYear();
            //     var dateObj = new Date(yyyy, mm - 1, dd);
            //     var dayWeek = ["Вс", "Пн", "Вт", "Ср", "Чт", "Пт", "Сб"][dateObj.getDay()];
            //     var numday = (date.getDate() > 7) ? Math.ceil(date.getDate() / 7) : 1;
            //
            //     var weekday = new Array(7);
            //     weekday[0] = 'Каждый ' + numday + ' Пн';
            //     weekday[1] = 'Каждый ' + numday + ' Вт';
            //     weekday[2] = 'Каждую ' + numday + ' Ср';
            //     weekday[3] = 'Каждый ' + numday + ' Чт';
            //     weekday[4] = 'Каждую ' + numday + ' Пт';
            //     weekday[5] = 'Каждую ' + numday + ' Сб';
            //     weekday[6] = 'Каждое ' + numday + ' Вс';
            //
            //     var dayOfWeek = weekday[date.getUTCDay()];
            //
            //     dd = (dd < 10) ? '0' + dd : dd;
            //     mm = (mm < 10) ? '0' + mm : mm;
            //
            //     var currentDate = dd + '.' + mm + '.' + yyyy;
            //
            //     if (access.indexOf('Ежедневно') > -1) {
            //         times[dd + '.' + mm + '.' + yyyy] = timesValues['Ежедневно'];
            //         return [true, ''];
            //     }
            //
            //     if (access.indexOf(dayOfWeek) > -1) {
            //         times[dd + '.' + mm + '.' + yyyy] = timesValues[dayOfWeek];
            //         return [true, ''];
            //     }
            //
            //     if ((access.indexOf('Пн')) > -1 && dayWeek == 'Пн') {
            //         times[dd + '.' + mm + '.' + yyyy] = timesValues['Пн'];
            //         return [true, ''];
            //     }
            //
            //     if ((access.indexOf('Вт')) > -1 && dayWeek == 'Вт') {
            //         times[dd + '.' + mm + '.' + yyyy] = timesValues['Вт'];
            //         return [true, ''];
            //     }
            //
            //     if ((access.indexOf('Ср')) > -1 && dayWeek == 'Ср') {
            //         times[dd + '.' + mm + '.' + yyyy] = timesValues['Ср'];
            //         return [true, ''];
            //     }
            //
            //     if ((access.indexOf('Чт')) > -1 && dayWeek == 'Чт') {
            //         times[dd + '.' + mm + '.' + yyyy] = timesValues['Чт'];
            //         return [true, ''];
            //     }
            //
            //     if ((access.indexOf('Пт')) > -1 && dayWeek == 'Пт') {
            //         times[dd + '.' + mm + '.' + yyyy] = timesValues['Пт'];
            //         return [true, ''];
            //     }
            //
            //     if ((access.indexOf('Сб')) > -1 && dayWeek == 'Сб') {
            //         times[dd + '.' + mm + '.' + yyyy] = timesValues['Сб'];
            //         return [true, ''];
            //     }
            //
            //     if ((access.indexOf('Вс')) > -1 && dayWeek == 'Вс') {
            //         times[dd + '.' + mm + '.' + yyyy] = timesValues['Вс'];
            //         return [true, ''];
            //     }
            //
            //     if (access.indexOf(currentDate) > -1) {
            //         times[dd + '.' + mm + '.' + yyyy] = timesValues[currentDate];
            //         return [true, ''];
            //     } else {
            //         return [false, ''];
            //     }
            // },
            onSelect: function (dateText) {
                timePanel.hide();
                payPanel.show();

                // var datapickerTimeBlock = $('#datapicker-time');
                // var timeBlock = $('#datapicker-time > div.b-record-form--input.t-time');
                //
                // timeBlock.html('');
                //
                // var time = times[dateText];
                // var start = new Date(dateText.replace(/(\d+).(\d+).(\d+)/, '$2/$1/$3') + ' ' + time[0]);
                // var end = new Date(dateText.replace(/(\d+).(\d+).(\d+)/, '$2/$1/$3') + ' ' + time[1]);
                //
                // var breakCount = 48;
                // var current = start;
                // while (current <= end) {
                //     var currentStrTime = ((current.getHours() < 10) ? '0' + current.getHours() : current.getHours())
                //         + ':' + ((current.getMinutes() < 10) ? '0' + current.getMinutes() : current.getMinutes());
                //     var dd = current.getDate();
                //     var mm = current.getMonth() + 1;
                //     var yyyy = current.getFullYear();
                //     dd = (dd < 10) ? '0' + dd : dd;
                //     mm = (mm < 10) ? '0' + mm : mm;
                //     var value = dd + '.' + mm + '.' + yyyy + ' ' + currentStrTime;
                //
                //     timeBlock.html(timeBlock.html() + '<label><input onclick="$(\'.h-pull-right\').show();" type="radio" name="time" value="' + value + '"><span>' + currentStrTime + '</span></label>');
                //     current.setMinutes(current.getMinutes() + 60);
                //     if (breakCount-- < 0) break;
                // }
                //
                // datapickerTimeBlock.show();
            }
        });
    }
});