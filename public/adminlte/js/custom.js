
var urlSearchParams = new URLSearchParams(window.location.search);
var params = Object.fromEntries(urlSearchParams.entries());
var raw='';
$('.delete-btn').click(function()
{
  raw=this.parentElement.parentElement
  
  $('.modal-body').html('Are You Sure You Wanna Delete '+this.getAttribute('element'));
  $('.modal-footer .delete').attr('url',$(this).attr('url'));
})

$('.modal-footer .delete').click(function()
{
  $('#delete-modal').modal('hide')
  let url=this.getAttribute('url');
  let btn =this;
  $.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  },  
        });
  $.ajax({  
    type: 'DELETE',
    url: url,
    contentType: 'application/json',
    success:function(data)
    {
      console.log(data);
      document.querySelector('.toast-body').textContent=data.message;
      $('.toast').toast('show',1000000);
      if(data.status==1)
      {
       raw.remove(); 
      }
      else
      {
        console.log(data.status);
      }
      if (document.querySelectorAll('tr').length<3) 
      {
        url=window.location.pathname;
        if(typeof params !=='undefined')
        {
          url+='?';
         if (typeof params.page !=='undefined' ) 
         {
          if (params.page!=1) 
            params.page--;
          }
          keys=Object.keys(params);
          params=Object.values(params);
          params.forEach( function(param,index) {
            url+=keys[index]+"="+param+'&'
          });
        }
        window.location=url.substring(0, url.length - 1);
        
        
      }
    }
})
})
$('.linkdin').change(function(event) {
	if (this.checked==true)
	 {
	 	document.querySelector('input[name="linkdin_profile_url"]').disabled=false;
	}
	else
		document.querySelector('input[name="linkdin_profile_url"]').disabled=true;
});





