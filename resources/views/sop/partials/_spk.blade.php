<form action="/pengaturan/spk/{{ $kec->id }}" method="post" id="FormSPK">
    @csrf
    @method('PUT')

    <textarea name="spk" id="spk"></textarea>
    
</form>

<div class="d-flex justify-content-end">
    <button type="button" id="SimpanSPK" data-target="#FormSPK" class="btn btn-sm btn-github mb-0 btn-simpan btn btn-sm btn-dark mb-0">
        Simpan Perubahan
    </button>
</div>

<script>
    const quill = new Quill('#spk', {
      theme: 'snow'
    });
  </script>