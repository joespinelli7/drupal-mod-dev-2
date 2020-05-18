<template >
  <div  id="albums">
    <div class="row">
      <div class="col-md-3 col-sm-12"  v-for="album in albums">
        <div class="card">
          <img class="card-img-top album_img " v-bind:src="album.field_album_cover[0].url" v-bind:alt="album.field_album_cover[0].alt" style=";height: 200px;" >
          <div class="card-body">
            <h5 class="card-title album_title">  {{ album.title[0].value }} </h5>
            <div class="card-text">
              <p>
                <strong>Artist :</strong>
                <span>{{ album.field_artist[0].value }}</span>
              </p>
              <p>
                <strong>Genres :</strong>
                <span v-for ="genre in  album.field_genres ">
                                {{ genre.value }}
                            </span>
              </p>
              <p>
                <strong>Labels :</strong>
                <span>{{album.field_label[0].value}}</span>
                <span v-for ="label in  album.field_labels ">
                                {{ label.value }}
                            </span>
              </p>
            </div>
          </div>
        </div>
        <br>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    name: 'albums',
    //initializing data to be load into the component
    data() {
      return {
        albums: [],
        albums: this.getAlbums()
      }
    },
    methods: {
      //sending request ot get promise from the hitting URL
      getAlbums: function() {
        this.$http.get("http://edm.dd:8083/api/album").then(response => {
          this.albums = response.body;
          // console.log(this.albums);
        }, response => {
          console.log("Error fetching data from URL make sure your server up running");
        });
      }
    }
  };
</script>
