<div class="navigation">
    <ul>
      <li>
        <a href="#">
          <span class="icon"><ion-icon name="library-outline"></ion-icon></span>
          <span class="title">Kelurahan XYZ</span>
        </a>
      </li>
      <li>
        <a class="{{ Request::segment(1) == "" ? "active" : ""  }}" href="{{ url('/') }}">
          <span class="icon"><ion-icon name="archive-outline"></ion-icon></span>
          <span class="title">Arsip</span>
        </a>
      </li>
      <li>
        <a class="{{ Request::segment(1) == "about" ? "active" : ""  }}" href="{{ url('/about') }}">
          <span class="icon"><ion-icon name="help-outline"></ion-icon></span>
          <span class="title">About</span>
        </a>
      </li>
    </ul>
</div>