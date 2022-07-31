 pipeline {
 
    environment {
        registry = "obafema/tooling" 
        registryCredential = 'dockerhub-login' 
        dockerImage = ''
    }

    agent any

    stages {

        stage ('initial cleanup') {
          steps {
                dir("${WORKSPACE}") {
               deleteDir()
              }
            }
        }

        stage('Checkout SCM') {
          steps {
            git branch: 'feature', url: 'https://github.com/obafema/dockerization_tooling_app.git', credentialsId: 'github-login'
          }
       }

      // stage('remove existing image if there is any'){
      //   steps{
      //      sh 'docker rmi registry'
      //   }    
      // }
// write a command to ignore if the image does not exits, the stage should igonre the error and continue

       stage('Build Docker Image') {
         steps {
           script {
              dockerImage = docker.build registry
                  }
           } 
       }

        // stage('Run the container'){
        //   steps{
        //     sh 'docker run registry'
        //   }
        // }

        // stage('Test the Image before pusging to registry')
        //   steps{
        //     sh './imagetest'
        //   }

        stage('Tag the image'){
           steps {
              sh 'docker image tag ${registry}:latest ${registry}:feature-0.0.1'
          }
        }
         
        stage('Deploy docker image to docker hub') {
          steps {
            script {
            docker.withRegistry( '', registryCredential ) {
            dockerImage.push()
               }
            }

           }
        }

        stage('Remove unsused images'){
           steps{
            sh "docker rmi $registry:latest"
            sh "docker rmi ${registry}:feature-0.0.1"
          }
        }

      }

}