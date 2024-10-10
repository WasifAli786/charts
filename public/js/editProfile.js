let profile_image = document.getElementById('profile_image');
let profileImage = document.getElementById('profileImage');

function getProfileImage() {
  profile_image.click()
}

profile_image.onchange = evt => {
  console.log('done')
  const [file] = profile_image.files
  if (file) {
    profileImage.src = URL.createObjectURL(file)
  }
}