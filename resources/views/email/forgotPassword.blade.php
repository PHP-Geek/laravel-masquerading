

Dear {{$firstName}} {{$lastName}},<br/><br/>

To get started, click the link below to change your password.<br/><br/>

URL : <b> <a href="{{url('/recover?id='.$id.'&hash='.$hash)}}">click here to reset your password</a></b><br/>
Email/UserName - <b>{{$email}}</b><br/>
