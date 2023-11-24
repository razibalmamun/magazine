<div id="section-nav" class="category-ber border-bottom border-dark mt-3 shadow-sm">
    <div class="container-fluid">
        <div class="collapse p-2  navbar-collapse d-flex justify-content-between" id="navbarSupportedContent">
            <h4 class="m-0">জাতীয়</h4>
            <ul class="nav nav-tabs" role="tablist" id="PoliticsPills">
                <li class="nav-item">
                    <a class="nav-link PoliticsItem active" SubCategoryID="0" data-bs-toggle="tab" href="#allPloytics">সকল</a>
                </li>
            </ul>
            <a href="/get-news-by-category/3" class="btn btn-danger rounded-pill">সকল</a>
        </div>
    </div>
</div>

<div id="politics" class="section-container" style="min-height: 610px;">
    <div class="row mt-3" id="allPloytics">
        <div class="pLeadNes col-12 col-sm-12 col-md-7 col-lg-5">
            <div class="row" id="politicsLeadNews">
               <!--POLITICS LEAD NEWS-->
            </div>
        </div>
        <div class="pLeadNes col-12 col-sm-12 col-md-7 col-lg-4">
            <div class="row" id="politicsMainLeadNews">
               <!--POLITICS LEAD ONE NEWS-->
            </div>
        </div>
        <div class="psLeadNews col-12 col-sm-12 col-md-5 col-lg-3">
            <div class="titleNews2" id="politicsSideNews">
               <!--POLITICS SIDE NEWS-->
            </div>
        </div>
        <div id="areaFilter" class="mapArchive mt-3 col-12 col-sm-12 col-md-12 col-lg-12">
            <div class="row justify-content-md-between  justify-content-center">
                <div class="areaChose col-12 col-md-6 col-lg-12  mt-3">     
                    <div class="filter-body">             
                        <h3 class="border-bottom border-top bg-light p-2">আমাদের খবর</h3>
                        <form action="/LocalNews" method="get" class="form p-3">
                            <div class="row">
                                <div class="col">
                                    <select name="division" class="form-select shadow-none" id="division" aria-label="Default select example">
                                        <option  selected value="">বিভাগ</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <select name="district" class="form-select shadow-none" id="district" aria-label="Default select example">
                                        <option  selected value="">জেলা </option>
                                    </select>
                                </div>
                                <div class="col">
                                    <select name="upozela" id="upazila" class="form-select shadow-none" aria-label="Default select example">
                                        <option  selected value="">উপজেলা </option>
                                    </select>
                                </div>
                                <div class="col">
                                    <button class="btn btn-danger shadow-none text-center w-100">খুজুন</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="mapData" class="position-absolute">

</div>


{{--ADVERTISE SECTION--}}
<div id="home_middle_big_add" class="addBanner mt-5 mb-5 d-flex justify-content-center">

</div>


<script>


    //Map Script
    MouseMove('#BGD1806',"Dhaka",6);
    MouseMove('#BGD2432', "Khulna",3);
    MouseMove('#BGD2475', "Barisal",4);
    MouseMove('#BGD2476', "Chittagong",1);
    MouseMove('#BGD2488', "Sylhet",5);
    MouseMove('#BGD3255', "Rajshahi",2);
    MouseMove('#BGD5492', "Rangpur",7);


    function MouseMove(id,location,divitionID){
        $(id).on('mousemove', function (event){
            let x = event.pageX;
            let y =  event.pageY;
            mapData(location);
            $('#mapData').css({
                "top" : y + 5 + "px",
                "left" : x + 5 + "px",
                "cursor": "pointer",
                "color" : "white",
            })
        })

        $(id).mouseleave(function (){
            $('#mapData').empty();
        })
        $(id).on('click',function (){
            window.location.href = (site.front_site_url+"/LocalNews?division="+divitionID+"&district=&upozela=");
        })
    }



    function mapData(data){
        $('#mapData').empty();
        $('#mapData').append(`<h4 style="text-shadow: 2px 2px 1px black">${data}</h4>`);
    }


    Advertise('/advertise/home_middle_big_add',$('#home_middle_big_add'))

    HomePolitics()

    function HomePolitics(){
        PillsCategory('/category-by-id/3','#PoliticsPills','PoliticsItem')

        $('#PoliticsPills').on('click','.PoliticsItem',function (){
            BodyLoaderON();
            $('.PoliticsItem').removeClass('disabled')
            $(this).addClass('disabled')
            let id = $(this).attr('SubCategoryID');
            let politicsLeadNews = $('#politicsLeadNews');
            let politicsSideNews = $('#politicsSideNews');
            if(id === "0"){
                AllPoliticsNews();
            }else{
                GetData(`/get-all-news/${id}/lead_news/4/0/sub`, function (response){
                    if(response.status === 200){
                        politicsLeadNews.empty();
                        let data = response.data;
                        if(data.length > 0){
                            let order = 5;
                            for(let i = 0; i < data.length; i++){
                                for(let j = 0; j < order; j++){
                                    if(data[i].order == j){
                                        PoliticsLeadNews(data[i].id,data[i].title, data[i].sort_description , data[i].image, data[i].date);
                                    }
                                }
                            }
                        }else{
                            // politicsLeadNews.append(ErrorNotFoundData())
                        }
                    }
                });

                //Side News
                GetData(`/get-all-news/${id}/side_bar_news/4/0/sub`,function (response){
                    if(response.status === 200){
                        BodyLoaderOFF();
                        politicsSideNews.empty();
                        let data = response.data;
                        if(data.length > 0){
                            let order = 4;
                            for(let i = 0; i < data.length; i++){
                                for(let j = 0; j < order; j++){
                                    if(data[i].order == j+1){
                                        PoliticsSideNews(data[i].id,data[i].title, data[i].image, data[i].date);
                                    }
                                }
                            }
                        }else{
                            // politicsSideNews.append(ErrorNotFoundData())
                        }
                    }
                });
            }
        })


        AllPoliticsNews()



        //Area Filter
        GetData('/get-all-divisions', function (response){
            if(response.status === 200){
                let data = response.data;
                data.forEach(function (item){
                    $('#division').append(`
                <option value="${item.id}">${item.bn_name}</option>
               `)
                })
            }
        });

        //Division Wise District
        $('#areaFilter').on('change','#division', function(){
            let divisionID = $(this).val();
            $('#district').empty();
            $('#upazila').empty();
            $('#upazila').append(`<option value="">উপজেলা</option>`)
            $('#district').append(`<option value="">জেলা</option>`)
            GetData('/get-all-district-by-division/'+divisionID, function (response){
                if(response.status === 200){
                    let data = response.data;
                    data.forEach(function (item){
                        $('#district').append(`
                        <option value="${item.id}">${item.bn_name}</option>
                    `)
                    })
                }
            });
        });


        //District Wise Upazila
        $('#areaFilter').on('change','#district', function(){
            let districtID = $(this).val();
            $('#upazila').empty();
            $('#upazila').append(`<option value="">উপজেলা</option>`)
            GetData('/get-all-upozilla-by-district/'+districtID, function (response){
                if(response.status === 200){
                    let data = response.data;
                    data.forEach(function (item){
                        $('#upazila').append(`
                        <option value="${item.id}">${item.bn_name}</option>
                    `)
                    })
                }
            });
        });




        //functions
        function PoliticsLeadNews(newsID,title, subTitle, image, time){
            $('#politicsLeadNews').append(`
            <div class="col-12 col-sm-6 col-md-6 col-lg-6 mb-2">
                <a href="/get-news/${newsID}" class="card- mt-3 w-100 link" style="height: 310px;">
                    <img height="150px" style="object-fit: cover" src="${image}" height="180px" class="card-img-top" alt="${title}">
                    <div class="card-body- mt-2">
                        <h5 style="margin-bottom: 5px;" class="card-text fw-bold">${title}</h5>
                        {{-- <p class="rajnitiDesc  d-md-none d-lg-block line-3">${subTitle}</p>
                        <div class="d-flex justify-content-between">
                            <div class="d-flex f-13 align-items-center"><i class="fas fa-clock" style="margin-right: 5px"></i>${site.localeDate(time)}</div>
                        </div>--}}
                    </div>
                </a>
            </div>
        `)
        }

        function PoliticsMainLeadNews(newsID,title, subTitle, image, time){
            $('#politicsMainLeadNews').append(`
            <div class="col-12 col-sm-6 col-md-6 col-lg-12 mb-2">
                <a href="/get-news/${newsID}" class="card- mt-3 w-100 link" style="height: 310px;">
                    <img height="300px" style="object-fit: cover" src="${image}" height="180px" class="card-img-top" alt="${title}">
                    <div class="card-body- mt-2">
                        <h5 style="margin-bottom: 5px;" class="card-text fw-bold">${title}</h5>
                        <p class="rajnitiDesc  d-md-none d-lg-block line-3">${subTitle}</p>
                        {{-- <div class="d-flex justify-content-between">
                            <div class="d-flex f-13 align-items-center"><i class="fas fa-clock" style="margin-right: 5px"></i>${site.localeDate(time)}</div>
                        </div>--}}
                    </div>
                </a>
            </div>
        `)
        }

        function PoliticsSideNews(newsID,title,image,time){
            $('#politicsSideNews').append(`
                <a href="/get-news/${newsID}" class="news link border-bottom mt-0 mb-0">
                    <img class="image" src="${image}">
                    <div>
                        <h5  class="title line-2" style="margin-bottom: 1px!important;">${title}</h5>
                        <p class="hour m-0"><i class="fas  fa-clock" style="margin: 0 5px 0 0;"></i>${site.localeDate(time)}</p>
                    </div>
                </a>
            `)
        }


        function AllPoliticsNews(){
            let politicsLeadNews = $('#politicsLeadNews');
            let politicsSideNews = $('#politicsSideNews');
            GetData('/get-all-news/3/lead_news/5/0',function (response){
                if(response.status === 200){
                    politicsLeadNews.empty();
                    let data = response.data;
                    if(data.length > 0){
                        // let order = 5;
                        for(let i = 0; i < 5; i++){
                            if(i == 0) {
                                PoliticsMainLeadNews(data[i].id,data[i].title, data[i].sort_description , data[i].image, data[i].date);
                            } else {
                                PoliticsLeadNews(data[i].id,data[i].title, data[i].sort_description , data[i].image, data[i].date);
                            }
                        }
                    }else{
                        politicsSideNews.append(ErrorNotFoundData())
                    }
                }
            })

            //Side News
            GetData('/get-all-news/3/side_bar_news/4/4',function (response){
                if(response.status === 200){
                    console.log(response)
                    politicsSideNews.empty();
                    BodyLoaderOFF();
                    let data = response.data;
                    if(data.length > 0){
                       // let order = 7;
                        for(let i = 0; i < data.length; i++){
                            PoliticsSideNews(data[i].id,data[i].title, data[i].image, data[i].date);
                        }
                    }else{
                        PoliticsSideNews.append(ErrorNotFoundData())
                    }
                }
            });
        }
    }
</script>

