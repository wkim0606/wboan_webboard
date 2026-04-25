pipeline {
    agent any

    stages {
        stage('Git Pull') {
            steps {
                git 'https://github.com/wkim0606/wboan-webboard.git'
            }
        }

        stage('Docker Build') {
            steps {
                sh 'docker build -t wboan-webboard:latest .'
            }
        }

        stage('Kubernetes Deploy') {
            steps {
                sh '''
                docker save wboan-webboard:latest > webboard.tar
                sudo k3s ctr images import webboard.tar
                kubectl rollout restart deployment webboard-deployment
                '''
            }
        }
    }
}
