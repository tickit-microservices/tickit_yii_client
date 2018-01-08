$(document).ready(function () {
    var API_URL = '/projects';

    var startLoading = function ($target) {
        $target.find('.glyphicon').addClass('glyphicon-refresh spin');
    };

    var stopLoading = function ($target) {
        $target.find('.glyphicon').removeClass('glyphicon-refresh spin');
    };

    var markAsTicked = function ($target, newTick) {
        $target.attr('tick-id', newTick.id);
        $target.removeClass('not-ticked').addClass('ticked');
        $target.find('.glyphicon').removeClass('glyphicon-remove').addClass('glyphicon-ok');
    };

    var markAsNotTicked = function ($target) {
        $target.attr('tick-id', '');
        $target.removeClass('ticked').addClass('not-ticked');
        $target.find('.glyphicon').removeClass('glyphicon-ok').addClass('glyphicon-remove');
    };

    var tick = function ($target, projectId, date) {
        startLoading($target);

        var tickUrl = API_URL + '/' + projectId + '/ticks';
        $.ajax({
            url: tickUrl,
            method: 'POST',
            data: {
                'date': date
            },
            complete: function () {
                stopLoading($target);
            }
        }).done(function (newTick) {
            markAsTicked($target, newTick);
        });
    };

    var unTick = function ($target, projectId, tickId) {
        startLoading($target);

        var unTickUrl = API_URL + '/' + projectId + '/ticks/' + tickId;
        $.ajax({
            url: unTickUrl,
            method: 'DELETE',
            data: {
                'tickId': tickId
            },
            complete: function () {
                stopLoading($target);
            }
        }).done(function () {
            markAsNotTicked($target);
        });
    };

    var $ticksTable = $('.ticks');

    $ticksTable.on('click', '.not-ticked', function () {
        var $target = $(this);
        var projectId = $target.attr('project-id');
        var date = $target.attr('date');

        tick($target, projectId, date);
    });

    $ticksTable.on('click', '.ticked', function () {
        var $target = $(this);
        var tickId = $target.attr('tick-id');
        var projectId = $target.attr('project-id');

        unTick($target, projectId, tickId);
    });
});