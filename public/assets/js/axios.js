// axios({
//     method: 'post',
//     url: '/user/devis',
//     data: {
//       monBien: Q1,
//       mesBesoins: besoins,
//       monMessage: mess
//     }
// });

axios.post('http://localhost:8000/user/devis', {
  params: {
    monBien: Q1,
    mesBesoins: besoins,
    monMessage: mess
  }
})
  .then(response => {
    console.log(response.data);
  })
  .catch(error => {
    console.error(error);
  });