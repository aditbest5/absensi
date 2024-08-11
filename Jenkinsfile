pipeline {
    agent any
    triggers {
        githubPush()
    }

    stages {
        stage('Build') {
            steps {
                // Install dependencies using Composer
                sh 'composer install'
            }
        }

        stage('Deliver') {
            steps {
                // Stop the currently running application (if any)
                sh '''
                    if pgrep -f "php -S localhost:5500"; then
                        pkill -f "php -S localhost:5500"
                    fi
                '''

                // Start the PHP application on port 5500
                sh '''
                    nohup php -S localhost:5500 -t public/ > /dev/null 2>&1 &
                '''
            }
        }
    }
}
