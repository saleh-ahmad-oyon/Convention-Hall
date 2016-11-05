(function ($) {
    $(document).ready(function () {

        ;(function ($, window, document, undefined) {
            $.fn.cf = function () {
                return this.each(function () {
                    var
                        $this = $(this),
                        $ccbx = $this.find('.ccbx'),
                        $crbtn = $this.find('.crbtn'),
                        checkbox = $ccbx.find(':checkbox'),
                        radiobtn = $ccbx.find('input:radio');

                    var innerEls = checkbox.is(':disabled') && !checkbox.is(':checked') ?
                         '<span title="You can\'t select this. Amount will be calculated based on no. of guests."><i></i></span>' :
                         '<span><i></i></span>';

                    $ccbx.find('input').wrap(innerEls);
                    $crbtn.find('input').wrap(innerEls);

                    $ccbx.on('click', function (e) {
                        e.preventDefault();
                        var
                            $this = $(this);
                        $this.toggleClass('checked');
                        $this.find(':checkbox').attr('checked', $this.hasClass('checked'));
                    });


                    $this.find('[checked="checked"]').closest('.ccbx').addClass('checked');
                    $this.find('[checked="checked"]').closest('.crbtn').addClass('pushed');

                    if (checkbox.is(':disabled')) {
                        $this.find(':disabled').parent().parent().parent('.ccbx').off().addClass('disabled');
                    }
                });
            }
        })(jQuery, window, document);
        /* fire cf */
        $('.cf').cf();
    }); //end doc ready
})(jQuery);