$('.dial').knob({
    'min': 0,
    'max': 100,
    'width': 90,
    'height': 90,
    'displayInput': true,
    'fgColor': "#3FA1A6",
    'bgColor': "",
    'thickness': 0.2,
    "readOnly": true,
    draw: function() {
        $(this.i).val(this.cv + '%')
    },
});