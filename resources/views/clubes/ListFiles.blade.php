@extends('layouts.system')

@section('content')
<div >
    <?php
    use Illuminate\Support\Facades\Storage;
   //$storage = storage_path().DIRECTORY_SEPARATOR.'app'.DIRECTORY_SEPARATOR.'especialidades'.DIRECTORY_SEPARATOR.'*';
  // $storage = Storage::disk('local')->get('especialidades'.DIRECTORY_SEPARATOR.'.');
   $storage = Storage::get('*.png');
   //foreach ($storage AS $item){
   dd($storage);
  // }
    ?>
</div>
@endsection
@section('scripts')
    <script src="{{asset('js/app.js')}}"></script>
@endsection
