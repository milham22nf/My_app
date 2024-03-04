var paginate = 1;
var dataExplore = [];
loadMoreData(paginate);
$(window).scroll(function(){
    if($(window).scrollTop() + $(window).height() >= $(document).height()){
        paginate++;
        loadMoreData(paginate);
    }
})

function loadMoreData(paginate){
    var urlnya = window.location.href.split("?")[1];
    var parameter = new URLSearchParams(urlnya);
    var cariValue = parameter.get('cari')
    if (cariValue == null) {
        url = window.location.origin + '/getDataExplore/' + '?page=' + paginate;
    } else {
        url = window.location.origin + '/getDataExplore?cari=' + cariValue + '&page=' + paginate;
    }
    $.ajax({
        url: url,
        type: "GET",
        dataType: "JSON",
        success: function(e){
            console.log(e)
            e.data.data.map((x)=>{
                var tanggal = x.created_at;
                var tanggalObj = new Date(tanggal);
                var tanggalFormated = ('0' + tanggalObj.getDate()).slice(-2);
                var bulanFormated = ('0' + (tanggalObj.getMonth() + 1)).slice(-2);
                var tahunFormated = tanggalObj.getFullYear();
                var tanggalUpload = tanggalFormated + '-' + bulanFormated + '-' + tahunFormated;
                var hasilPencarian = x.like.filter(function(hasil){
                    return hasil.id_user === e.idUser
                })
                if(hasilPencarian.length <= 0){
                    userLike = 0;
                } else {
                    userLike = hasilPencarian[0].id_user;
                }
                let datanya = {
                    id: x.id,
                    judul: x.judulfoto,
                    deskripsi: x.deskripsifoto,
                    foto: x.url,
                    tanggal: tanggalUpload,
                    usid : x.user.id,
                    namauser: x.user.user_name,
                    fotuser: x.user.picture,
                    jml_Komentar: x.komentar_count,
                    jml_Like: x.like_count,
                    idUserLike: userLike,
                    useractive: e.idUser
                }
                dataExplore.push(datanya)
                console.log(userLike)
                console.log(e.idUser)
            })
            getExplore()
        },
        error: function(jqXHR, textStatus, errorThrown){
            
        }
    })
}

const getExplore =()=>{
    $('#exploredata').html('')
    dataExplore.map((x, i)=>{
        $('#exploredata').append(
            `
            <div class="flex mt-2 bg-white shadow-md">
            <div class="flex flex-col px-1">
                <div class="px-2 mt-2">
                    <a href="/other-profile/${x.usid}">                
                    <div class="flex space-x-1 md:order-2 md:space-x-0 rtl:space-x-reverse px-2 py-2">
                        <img src="/foto/${x.fotuser}" alt="" class="w-10"> 
                        <div class="items-center justify-center px-2 mt-1">
                            <h3 class=" text-2xl font-serif">${x.namauser}</h3>
                        </div>
                    </div>
                    </a>                     
                </div>
                <a href="/explore-detail/${x.id}">
                    <div class="w-[363px] h-[192px] bg-bgcolor2 overflow-hidden">
                        <img src="/foto/${x.foto}" alt="" class="w-full transition duration-500 ease-in-out hover:scale-105">
                    </div>
                </a>
                <div class="flex flex-wrap items-center justify-between px-2 mt-2">
                    <div>
                        <div class="flex flex-col">
                            <div>
                                ${x.judul}
                            </div>
                            <div class="text-xs text-gray">
                                ${x.tanggal}
                            </div>
                        </div>
                    </div>
                    <div>
                        <small>
                        ${x.jml_Komentar}
                        </small>
                        <a href="/explore-detail/${x.id}">
                        <span class="bi bi-chat-left-text"></span>
                        </a>
                        <small>
                        ${x.jml_Like}
                        </small>
                        <span class="bi ${x.idUserLike === x.useractive ? 'bi-heart-fill text-red-800' : 'bi-heart'}" onclick="Likes(this, ${x.id})"></span>
                    </div>
                </div>
            </div>
        </div>
            `
        )
    })
}

function Likes(txt , id){
    $.ajax({
        url:    window.location.origin +'/likefotos',
        dataType:   "JSON",
        type: "POST",
        data: {
            _token: $('input[name="_token"]').val(),
            idfoto: id
        },
        success: function(res){
            console.log(res)
            location.reload()
        }, 
        error: function(jqXHR, textStatus, errorThrown){
            alert('gagal')
        } 
    })
}