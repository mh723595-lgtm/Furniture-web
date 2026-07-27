<title>{{ $pageTitle }}</title>
<meta name="description" content="{{ $pageDescription }}">
<meta name="keywords" content="{{ $pageKeywords }}">
<link rel="canonical" href="{{ $canonicalUrl }}">

<meta property="og:type" content="website">
<meta property="og:title" content="{{ $pageTitle }}">
<meta property="og:description" content="{{ $pageDescription }}">
<meta property="og:url" content="{{ $canonicalUrl }}">
<meta property="og:locale" content="id_ID">
@if($ogImage)
<meta property="og:image" content="{{ $ogImage }}">
@endif

<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $pageTitle }}">
<meta name="twitter:description" content="{{ $pageDescription }}">
@if($ogImage)
<meta name="twitter:image" content="{{ $ogImage }}">
@endif
