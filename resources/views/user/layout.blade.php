

    @include("user.includes.head")
    <main role="content" class="container-main container container-custom">
         @include("user.includes.header")
         <div class="row">
              @include("user.includes.sidebar")
                @yield("content")
         </div>
    </main>
    <!-- Footer of the page Starts...  -->
    
          



  @include("farmer.includes.footer")
   @yield('js')
</body>
</html>