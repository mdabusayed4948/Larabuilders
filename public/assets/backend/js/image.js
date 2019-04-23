   //---------Browse Photo------------------
    $('#browse_file').on('click',function(){
        $('#photo').click();
    })
    $('#photo').on('change',function(e){
        showFile(this,'#showPhoto');    
    })
//================================
    function showFile(fileInput,img,showName)
    {
        if (fileInput.files[0]) {
            var reader = new FileReader();
            reader.onload =function(e)
            {
                $(img).attr('src',e.target.result); 
            }
            reader.readAsDataURL(fileInput.files[0]);

        }
        $(showName).text(fileInput.files[0].name)
    };