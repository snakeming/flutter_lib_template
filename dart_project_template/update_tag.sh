TAG=$1

if [[ $TAG =~ [A-Z] ]]; then
	echo "Tag has Upper case letter. Please use lower case v1.0 style"
elif [ "$TAG" == '' ]; then
    echo "Tag (e.g: v1.0) is required."
    echo "now use 'git tag' to list out current tags:"
    git tag
else
	git tag -d $TAG
	git push origin --delete $TAG
	git tag $TAG
	git push origin $TAG
fi
