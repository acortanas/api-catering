# api-catering

1.  data/lists.json  --> file JSON yg diambil dari api zomato

2.  views/site/index.php
    -- >  last modified : 2019-05-26
          data dari json sudah tampil ke home page
          
3.  controllers/SiteController.php
    -- >  last modified : 2019-05-28
          (-) homepage masih bisa diakses meskipun user belum login/sudah logout
          sudah dicoba ditambah session tapi masih error (semua script tambahan sudah dikomen)
