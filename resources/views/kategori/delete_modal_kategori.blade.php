<!-- Modal -->
@foreach ($data_kategori as $kategori) 
<div class="modal fade" id="deleteKategoriModal{{$kategori->kd_kategori}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Data kategori</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="{{url("/kategori/".encrypt($kategori->kd_kategori))}}" method="POST">
            @csrf
            @method('delete')
            Yakin Akan Menghapus Data?
            <div style="margin-top: 20px" class="modal-footer">
            <button type="button" class="btn btn-info" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-success">Delete</button>
            </div>
          </form>
        </div>
        
      </div>
    </div>
  </div>
  @endforeach