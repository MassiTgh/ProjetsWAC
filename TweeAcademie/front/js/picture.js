window.onload = function () {
    document.querySelector('input[type="file"]').addEventListener('change', function(event) {
        let file = event.target.files[0];
        let reader = new FileReader();

        reader.onloadend = function() {
            fetch('../back/tweet.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ tweet_image: reader.result })
            })
                .then(response => response.json())
                .then(data => {
                    document.getElementById('tweetImage').src = data.image_path;
                });
        };

        reader.readAsDataURL(file);
    });
}