$.getJSON('/album/getDataAlbumprof', function(res){
    console.log(res);
    
    // Memperbarui tampilan dengan data profil pengguna
    $('#namauser').html(res.dataUser.user_name);
    $('#bio').html(res.dataUser.bio);
    $('#nomtel').html(res.dataUser.no_telp);
    $('#nama').html(res.dataUser.name);
    $('#imageuser').prop('src', '/foto/' + res.dataUser.picture);
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
    var segmentTerakhir = window.location.origin + '/album/getDataAlbumprof';
    $.ajax({
        url: window.location.origin+'/getDataProfileAlbumExplore/'+'?page='+paginate,
        type: "GET",
        dataType: "JSON",
        data:{
            idUser: segmentTerakhir
        },
        success: function(e){
            console.log(e)
            e.data.data.map((x)=>{
                let datanya = {
                    id: x.id_user,
                    judul: x.judul_album,
                    deskripsi: x.deskripsi_album,
                }
                dataExplore.push(datanya)
            })
            getExplore()
        },
        error: function(jqXHR, textStatus, errorThrown){
            
        }
    })
}

const getExplore =()=>{
    $('#exploredataprouser').html('')
    dataExplore.map((x, i)=>{
        $('#exploredataprouser').append(
            `
            <div class="flex mt-2 bg-white shadow-md">
            <div class="flex flex-col px-1">
                <div class="px-2 mt-2"> 
                </div>

                <a href="/album-foto/${x.id}">
                    <div class="w-[363px] h-[192px] bg-bgcolor2 overflow-hidden">
                        <img src="/assets/file.png" alt="" class="w-full transition duration-500 ease-in-out hover:scale-105">
                    </div>
                </a>
                <div class="flex flex-wrap items-center justify-between px-2 mt-2">
                    <div>
                        <div class="flex flex-col">
                            <div>
                                ${x.judul}
                            </div>
                            <div class="text-xs text-gray">
                                ${x.deskripsi}
                            </div>
                        </div>
                    </div>
                    <div>
                    </div>
                </div>
            </div>
        </div>
            `
        )
    })
}
