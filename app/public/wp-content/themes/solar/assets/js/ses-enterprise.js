jQuery(function ($) {
    const tick = 2000;

    function clamp(val, min, max) {
        return Math.max(min, Math.min(max, val));
    }

    function update() {

        let consumptionBase = 100;
        let consumption = clamp(
            consumptionBase + (Math.random() * 20 - 10),
            98,
            104
        );

        let solar = clamp(
            consumption / 1.2 + (Math.random() * 10 - 5),
            0,
            consumption
        );

        let grid = consumption - solar;

        solar = Math.round(solar * 100) / 100;
        grid = Math.round(grid * 100) / 100;
        consumption = Math.round(consumption * 100) / 100;

        let solarPercent = (solar / consumption) * 100;
        let gridPercent = (grid / consumption) * 100;

        $('.ses-3-body-item-1 .ses-3-body-item-col-active')
            .css('height', gridPercent + '%');

        $('.ses-3-body-item-2 .ses-3-body-item-col-active')
            .css('height', '100%');

        $('.ses-3-body-item-3 .ses-3-body-item-col-active')
            .css('height', solarPercent + '%');

        $('.ses-3-body-item-1 strong').text(grid);
        $('.ses-3-body-item-2 strong').text(consumption);
        $('.ses-3-body-item-3 strong').text(solar);

        $('.ses-3-body-right-body-value').eq(0).text(solar);
        $('.ses-3-body-right-body-value').eq(1).text(consumption);
        $('.ses-3-body-right-body-value').eq(2).text(grid);

        $('.ses-3-body-bottom-left strong').text(solar);
        $('.ses-3-body-bottom-right strong').text(grid);
    }

    update();
    setInterval(update, tick);











});