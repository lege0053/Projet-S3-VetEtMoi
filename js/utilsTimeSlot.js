document.getElementById('tab').addEventListener("change", function(){
    charge('json/getTimeSlotByDateAndVetoId.php','','',this.options[this.selectedIndex].value)
})

function charge(url, lowDate, upDate, vetoId)
{
    if(request!=null)
        request.cancel();
    request=new AjaxRequest(
        {
            url        : url,
            method     : 'post',
            handleAs : 'json',
            parameters : {
                lowDate : lowDate,
                upDate : upDate,
                vetoId : vetoId
            },
            onSuccess  : function(res) {
                //actualiser le tableau avec le résultat de la request.
            },
            onError    : function(status, message) {
                //window.alert('Error ' + status + ': ' + message) ;
            }
        }) ;
}
