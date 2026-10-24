@extends('layouts.app')

@section('title', 'Multi Languages Gateway — Japanese, Korean, Chinese &amp; IELTS in Dhaka')
@section('description', 'Japanese (JLPT), Korean (TOPIK), Chinese (HSK) and IELTS courses in Dhaka — online or in class — plus university admission, scholarships and visa guidance for Japan, Korea and China.')

@section('og')
    <meta property="og:type" content="website">
    <meta property="og:title" content="Multi Languages Gateway — Language training &amp; study abroad">
    <meta property="og:description" content="Japanese, Korean, Chinese and IELTS — online or in class — with admission, scholarship and visa support for Japan, Korea and China.">
    <meta property="og:locale" content="en_US">
    <meta property="og:locale:alternate" content="bn_BD">
@endsection

@push('schema')
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "EducationalOrganization",
  "name": "{{ \App\Support\Site::get('site_name', 'Multi Languages Gateway') }}",
  "alternateName": "MLG",
  "description": "Language institute and study-abroad consultancy in Dhaka, Bangladesh — Japanese, Korean, Chinese and IELTS courses with admission and visa support for Japan, Korea and China.",
  "url": "https://example.com/",
  "telephone": "{{ \App\Support\Site::get('phone_raw') }}",
  "email": "{{ \App\Support\Site::get('email') }}",
  "address": {
    "@@type": "PostalAddress",
    "streetAddress": "{{ \App\Support\Site::get('address_line1') }}",
    "addressLocality": "Dhaka",
    "postalCode": "1205",
    "addressCountry": "BD"
  },
  "sameAs": []
}
</script>
@endpush

@section('content')
@include('home.01-animated-hero')
@include('home.02-course-grid')
@include('home.03-study-abroad')
@include('home.04-application-process')
@include('home.05-online-vs-in-class')
@include('home.06-batch-schedule')
@include('home.07-why-choose-us')
@include('home.08-results-board')
@include('home.09-faculty')
@include('home.10-acceptance-letters')
@include('home.11-success-stories')
@include('home.12-universities')
@include('home.13-mock-test-booking')
@include('home.14-pricing')
@include('home.15-chairman-s-message')
@include('home.16-about-facility')
@include('home.17-seminar')
@include('home.18-blog')
@include('home.19-faq')
@include('home.20-final-cta')
@endsection
