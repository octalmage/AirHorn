jQuery(document).on("ready", function()
{
        var airhorn = new Howl({
                urls: [airhorn_vars.url]
        })
        jQuery(".airhorn_button").on("click", function()
        {
                airhorn.play();
        });
});