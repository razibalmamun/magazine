 <div id="marque" style="background: #F3F3F3;padding: 0; height: auto;" class="d-flex align-items-center">
    <div class="bg-danger text-white pt-2 pb-2 ps-3 pe-3">শিরোনামঃ </div>
    <marquee   direction="left" style="width: 79.5vw">
        <button type="button" id="MarqueFixedBottomClose" class="position-absolute btn" style="right: 10px;top: -15px;">
            <i class="fas fa-times text-danger"></i>
        </button>
        
        <div id="marque-news" class="pt-2 pb-2 ps-3 pe-3"></div>
        
    </marquee>
</div>

<script>
   GetData('/get-marquee/2023-03-26', function (res) {
       if(res.status === 200){
           res.data.forEach(function (item){
               $('#marque-news').append(`
                    <a href="#" style="text-decoration:none;color: black;" class="ps-2 pe-2 d-inline-block border-danger border-right">  
                    <i class="fa-solid text-danger fa-bring-forward"></i>
                    ${item.title} </a>
                `)
           })
       }
   })

    $('#MarqueFixedBottomClose').click(function () {
        $('#marque').remove();
        $('#AdvertiseBottomFixed').css("bottom","0")
    })
    
    //marque ki ase ? 
</script>
