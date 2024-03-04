var segmentTerakhir = window.location.href.split("/").pop();

$.getJSON(window.location.origin + '/other-profile/getDataOtherprof/' + segmentTerakhir, function(res) {
    console.log(res);
    $('#namauser').html(res.dataUser.user_name);
    $('#bio').html(res.dataUser.bio);
    $('#notel').html(res.dataUser.no_telp);
    $('#nama').html(res.dataUser.name);
    $('#imageuser').prop('src', '/foto/' + res.dataUser.picture);
    $('#linkuser').prop('href', '/other-profile/' + res.dataUser.id);
    $('#linkalbumuser').prop('href', '/other-album/' + res.dataUser.album.id_user);
}).fail(function(jqXHR, textStatus, errorThrown) {
    console.error("Error: " + textStatus, errorThrown);
    alert('Gagal memuat data pengguna.');
});


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
    $.ajax({
        url: window.location.origin+'/getDataOtherProfileExplore/'+'?page='+paginate,
        type: "GET",
        dataType: "JSON",
        data:{
            idUser: segmentTerakhir
        },
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
    $('#exploredatauser').html('')
    dataExplore.map((x, i)=>{
        $('#exploredatauser').append(
            `
            <div class="flex mt-2 bg-white shadow-md">
            <div class="flex flex-col px-1">
                <div class="px-2 mt-2"> 
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