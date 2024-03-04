var segmentTerakhir = window.location.href.split('/').pop();

$.ajax({
    url: window.location.origin +'/explore-detail/'+segmentTerakhir+'/getdatadetail',
    type: "GET",
    dataType: "JSON",
    success: function(res){
        console.log(res)
        $('#fotodetail').prop('src','/foto/'+res.dataDetailFoto.url)
        $('#judulfoto').html(res.dataDetailFoto.judulfoto)
        $('#deskripsi').html(res.dataDetailFoto.deskripsifoto)
        $('#username').html(res.dataDetailFoto.user.user_name)
        $('#userfoto').prop('src','/foto/'+res.dataDetailFoto.user.picture)
        $('#username').prop('href','/other-profile/'+res.dataDetailFoto.user.id)
        ambilKomentar()
    },
    error: function(jqXHR, textStatus, errorTrown){
        alert('gagal')
    }
})



function ambilKomentar(){
    $.getJSON(window.location.origin +'/explore-detail/getComment/'+segmentTerakhir, function(res){
        console.log(res)
        if(res.data.length === 0){
            $('#listkomentar').html('<div> Belum Ada Komentar </div>')
        } else {
            komentar = []
            res.data.map((x)=>{
                var tanggal = x.created_at;
                var tanggalObj = new Date(tanggal);
                var tanggalFormated = ('0' + tanggalObj.getDate()).slice(-2);
                var bulanFormated = ('0' + (tanggalObj.getMonth() + 1)).slice(-2);
                var tahunFormated = tanggalObj.getFullYear();
                var tanggalUpload = tanggalFormated + '-' + bulanFormated + '-' + tahunFormated;
                let datacomentar = {
                    idUser: x.user.id,
                    pengirim: x.user.user_name,
                    waktu: tanggalUpload,
                    isikomentar: x.isi_komentar,
                    fotopengirim: x.user.picture
                }
                komentar.push(datacomentar);
            })
            tampilkankomentar()
        }
    })
}


const tampilkankomentar = ()=>{
    $('#listkomentar').html('')
    komentar.map((x, i)=>{
    $('#listkomentar').append
    (
    `
    <div class="flex flex-row justify-start mt-4"> 
        <div class="w-1/4"> 
            <img src="/foto/${x.fotopengirim}" class="w-8 h-auto" alt=""> 
        </div> <div class="flex flex-col mr-2"> 
            <h5 class="text-sm">${x.pengirim}</h5> 
            <small class="text-xs text-gray">${x.waktu}</small> 
        </div> 
            <h5 class="text-sm">${x.isikomentar}</h5> 
    </div> 
    `
    )
    })
}

function kirimkomentar(){
    $.ajax({
        url: window.location.origin +'/explore-detail/kirimkomentar',
        type: "POST",
        dataType: "JSON",
        data: {
            _token: $('input[name="_token"]').val(),
            idfoto: segmentTerakhir,
            isi_komentar: $('input[name="textkomentar"]').val()
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
        url: window.location.origin+'/getDataDetailExplore/'+'?page='+paginate,
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
                    usid: x.user.id,
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
    $('#exploreDetaildata').html('')
    dataExplore.map((x, i)=>{
        $('#exploreDetaildata').append(
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