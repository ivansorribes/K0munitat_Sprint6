@extends('layout.basic')

@section('title', 'Community')

@section('content')
<link rel="stylesheet" type="text/css" href="../../css/communities.css" />

<body>
    <div id="advertisementList"></div>
    <script type="text/javascript">
        window.postsData = @json($posts);
        window.communityData = @json($community);
    </script>
</body>
@endsection