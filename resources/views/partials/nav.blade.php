<nav class="dashboard-nav">
    <ul>
        <li><a href="{{ route('dashboard', ['role' => 'technicien']) }}">📁 Technique</a></li>
        <li><a href="{{ route('dashboard', ['role' => 'adv']) }}">📁 ADV</a></li>
        <li><a href="{{ route('dashboard', ['role' => 'comptabilite']) }}">📁 Comptabilité</a></li>
        <li><a href="{{ route('dashboard', ['role' => 'commerciaux']) }}">📁 Commerciaux</a></li>
    </ul>
</nav>
<aside class="dashboard-nav">
    <ul>
        <li><a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">🏠 Tableau de bord</a></li>
        <li><a href="{{ route('admin.video.index') }}">🎬 Tutoriels Vidéo</a></li>
        <li><a href="#">📄 Tutoriels PDF</a></li>
        <li><a href="#">📰 Articles de blog</a></li>
    </ul>
</aside>
