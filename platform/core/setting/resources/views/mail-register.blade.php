<p><b>Fullname:</b> {{$data['fullname']}}</p>
<p><b>Phone:</b> {{$data['phone']}}</p>
<p><b>Email:</b> {{$data['email']}}</p>
<p><b>Address:</b>{{$data['address']}}</p>
<p><b>Age:</b> {{$data['age']}}</p>
<p><b>Categories:</b></p>
@foreach($data['category'] as $cat)
<p>- {{$cat}}</p>
@endforeach
<p><b>Guardian Name</b> {{$data['guardian_name']}}</p>
<p><b>Guardian Phone</b> {{$data['guardian_phone']}}</p>
<p><b>Guardian Email</b> {{$data['guardian_email']}}</p>
<p><b>Video Link</b> {{$data['video_link']}}</p>
