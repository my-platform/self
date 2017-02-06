$(document).ready(function(){
   // var val =$('#first-check').val();
//alert('hello');
   /* $('#first-check').each(function () {
        if($(this).is(":checked")){
            alert('zeft');
            var val2 = $(this).val();
            $('#feedback').val(val2);
        }
    });*/
   /* $('.mailbox-msg input[type="checkbox"]').iCheck({
        checkboxClass: 'icheckbox_flat-blue',
        radioClass: 'iradio_flat-blue'
    });*/
    $('.toggle-div #toggle-check').change(function () {
        // check all /uncheck all
        $(".mailbox-msg input[type='checkbox']").prop('checked',$(this).prop('checked'));
        var checked = $(this).prop('checked');
          var value = [];                       // array variable
        //if all checked
        if (checked) {
            $('.sp').addClass('fa-check');
            $('.mailbox-msg input:checked').each(function () {
          var val =$(this).attr('value') ; // another variable to get the value and push it later in the array
          value.push(val);  // store values in an array
            });
            $('#paragraph2').text('My favorite food is: '+ value );
            $('#feedback').val(value);
            //if all doesn't checked
        } else if(!checked){
            $('.sp').removeClass('fa-check');
            $('#paragraph2').text('My favorite food is: ' + value);
            $('#feedback').text(value);
        }

    });
    $('.mailbox-msg #target-check').change(function () {
        // check individual
        var checked = $(this).prop('checked');
        var current = $(this).attr('value');
       // var value = '';
        var value = [];
        if (checked) {
            $('.mailbox-msg input:checked').each(function () {
                // value +=$(this).attr('value') + ', '; //  add the current value to the value variable
                 var val =$(this).attr('value'); // another variable to get the value and push it later in the array
                value.push(val);  // store values in an array
                $(this).next().addClass('fa-check');

            });
            $('#paragraph2').text('My favorite food is: '+ value );
            $('#feedback').val(value);
        }
        if(!checked) {
            $('.mailbox-msg input:checked').each(function () {
                var checked_elements = $(this).attr('value');
                value.push(checked_elements);
            });
            var index = value.indexOf(current);
            if (index > -1) {
                value.splice(index, 1);
            }
            $('#paragraph2').text('My favorite food is:' + value);
            $(this).next().removeClass('fa-check');
        }
       
    });

 
   /* if($('.mailbox-msg #first-check').attr('value')){
        var state = $(this).attr('value');
        alert(state);
        $('#feedback').show();
        //$('#feedback').toggle(this.checked());
      /*  if(state =='on'){
            $('#feedback').val('on');
        }else if(state ==''){
            $('#feedback').val('off');
        }*/

    //}
   /* if($('.mailbox-msg #first-check').attr('checked')) {
        var state = $(this).attr('value');
        alert(state);
          $('#feedback').hide();
    }else {
        $('#feedback').show();
    }*/

    //alert('zeft');
       // $('#feedback').val($(this).text());
        //var val3 = $(this).val();
       // $('#feedback').val(val3);

    //alert('nothing');
  /*  $('.mailbox-msg input[type="checkbox"]').iCheck({
        checkboxClass: 'icheckbox_flat-blue',
        radioClass: 'iradio_flat-blue'
    });*/
   /* $('.mailbox-msg input[type="checkbox"]').click(function () {
        var clicks = $(this).data('clicks');
        alert(clicks);
    });*/

   // $('#feedback').val(val);
});